<?

namespace app\models;

use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $name;


    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
        ];
    }
    public function signup()
    {
        if($this->validate())
        {
            $user = new User();
            $user->attributes = $this->attributes;
            return $user->create();
        }
    }
}