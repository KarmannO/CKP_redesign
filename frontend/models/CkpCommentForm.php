<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 09.03.2017
 * Time: 12:57
 */

namespace frontend\models;


use common\models\CkpComment;
use common\models\User;
use frontend\components\activities\ActivityHandler;
use yii\base\Model;

/**
 * Class CkpCommentForm
 * @package frontend\models
 * Class for representing comments model fields as user input form.
 */
class CkpCommentForm extends Model
{
    /**
     * @var CkpComment::$comment_text full comment text.
     */
    public $comment_text;

    public function rules()
    {
        return [
            ['comment_text', 'required', 'message' => 'Поле не может быть пустым']
        ];
    }

    public function attributeLabels()
    {
        return [
            'comment_text' => 'Текст комментария'
        ];
    }

    public function send($ckp_id)
    {
        if(!$this->validate())
            return null;

        $comment = new CkpComment();
        $comment->user_id = User::getCurrentUser()->id;
        $comment->ckp_id = $ckp_id;
        $comment->message_text = $this->comment_text;
        $comment->timestamp = time();

        $saved_comment = $comment->save();
        if($saved_comment)
        {
            $info = ActivityHandler::handleCkpComment(
                $comment->id,
                $comment->user_id,
                $comment->ckp_id,
                $comment->message_text
            );
            ActivityHandler::register_activity(3, $info);
            return $saved_comment;
        }
        else
            return null;
    }
}