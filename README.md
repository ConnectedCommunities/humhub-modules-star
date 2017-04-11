# Star
This module adds the ability to Star/Favourite objects. Please note, this is not a standalone module, it requires integration.

## Installation 
- Clone the star module into your modules directory 
```
cd protected/modules
git clone https://github.com/ConnectedCommunities/humhub-modules-star.git star
```

- Go to Admin > Modules. You should now see the Star module in your list of installed modules

-  Click "Enable". This will install the Star module for you


## Usage
This is the first implementation of the Star module. 
It is not a standalone module, it needs to be used with modules/code that have integrated it.

### Add a Star
You can Star an object like so: 
```
use humhub\modules\star\models\Star;
// ...
$star = new Star();
$star->object_model = 'humhub\modules\questionanswer\models\Question';
$star->object_id = 1;
$like->save();
```

#### The Star Widget
To help reduce your development time, the module comes with a widget that lets you star and unstar an object.
```
$question = \humhub\modules\questionanswer\models\Question::findOne(['id' => 1]);
echo humhub\modules\star\widgets\StarLink::widget(array('object' => $question))
```

### Getting Stars
You can get the Stars on an object:
```
use humhub\modules\star\models\Star;
// ...
$stars = Star::GetStars('humhub\modules\questionanswer\models\Question', 1);
```

#### Showing a Star
Each object that can be starred can also have a widget that defines how that the starred object should be displayed (e.g. in the Star list at `star/views/list`)

Simply create a new widget with two parameters `star` and `object`
```
class StarredItem extends \yii\base\Widget
{

    public $object;

    public $star;
    
    public function run()
    {
        return $this->render('starredItem', array(
            'star' => $this->star,
            'object' => $this->object
        ));
    }

}
```

Then set the following property on your object's model. It might look *similar* to this.
```
class Answer extends ContentActiveRecord implements Searchable
{

    // ...
    
    /**
     * Class of widget to use to show starred item
     *
     * @var string StarredItem widget class
     */
    public $starredItemClass = "humhub\modules\questionanswer\widgets\StarredItem";
    
    // ...
    
}
```
