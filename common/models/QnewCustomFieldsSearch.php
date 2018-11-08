<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\QnewCustomFields;

/**
 * QnewCustomFieldsSearch represents the model behind the search form about `common\models\QnewCustomFields`.
 */
class QnewCustomFieldsSearch extends QnewCustomFields
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['custom_id', 'custom_catid', 'custom_subcatid', 'custom_min', 'custom_max', 'custom_required'], 'integer'],
            [['custom_page', 'custom_name', 'custom_title', 'custom_type', 'custom_content', 'custom_options', 'custom_default'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = QnewCustomFields::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'custom_id' => $this->custom_id,
            'custom_catid' => $this->custom_catid,
            'custom_subcatid' => $this->custom_subcatid,
            'custom_min' => $this->custom_min,
            'custom_max' => $this->custom_max,
            'custom_required' => $this->custom_required,
        ]);

        $query->andFilterWhere(['like', 'custom_page', $this->custom_page])
            ->andFilterWhere(['like', 'custom_name', $this->custom_name])
            ->andFilterWhere(['like', 'custom_title', $this->custom_title])
            ->andFilterWhere(['like', 'custom_type', $this->custom_type])
            ->andFilterWhere(['like', 'custom_content', $this->custom_content])
            ->andFilterWhere(['like', 'custom_options', $this->custom_options])
            ->andFilterWhere(['like', 'custom_default', $this->custom_default]);

        return $dataProvider;
    }
}
