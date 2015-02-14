<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\components\db\ActiveRecord;

/**
 * This is the model class for table "post_meta".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property string $type
 * @property string $description
 * @property string $count
 * @property string $order
 * @property string $created_at
 * @property string $updated_at
 */
class PostMeta extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_meta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['count', 'order', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['alias', 'type'], 'string', 'max' => 32],
            [['description'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'alias' => '变量（别名）',
            'type' => '项目类型',
            'description' => '选项描述',
            'count' => '项目所属内容个数',
            'order' => '项目排序',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }

    public static function blogCategory()
    {
        return ArrayHelper::map(static::find()->where(['type'=>'blog_category'])->all(), 'id', 'name');
    }

    public static function topicCategory()
    {
        return ArrayHelper::map(static::find()->where(['type'=>'topic_category'])->all(), 'id', 'name');
    }

    public function getTypes()
    {
        return [
            'blog_category' => '文章分类',
            'topic_category' => '社区分类',
        ];
    }

    public static function topic()
    {
        return ArrayHelper::map(static::find()->where(['type'=>'topic_category'])->all(), 'alias', 'name');
    }
}
