<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property string $identifier
 * @property string $currency_code
 * @property string $currency_name
 * @property string $country_name
 * @property string $country_code
 * @property string $country_flag
 */
class Country extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['identifier', 'currency_code', 'currency_name', 'country_name', 'country_code', 'country_flag'], 'required'],
            [['country_flag'], 'string'],
            [['identifier'], 'string', 'max' => 36],
            [['currency_code', 'currency_name', 'country_name', 'country_code'], 'string', 'max' => 255],
            [['country_code'], 'unique'],
            [['identifier'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'identifier' => 'Identifier',
            'currency_code' => 'Currency Code',
            'currency_name' => 'Currency Name',
            'country_name' => 'Country Name',
            'country_code' => 'Country Code',
            'country_flag' => 'Country Flag',
        ];
    }

}
