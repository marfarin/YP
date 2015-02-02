<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Company;

/**
 * CompanySearch represents the model behind the search form about `app\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public $category;
    public $user;
    
    public function rules()
    {
        return [
            [['_id', 'name', 'legal_form', 'legal_name', 'sphere', 'company_size', 'address_id', 'address_addition', 'phone_numbers', 'short_phone_numbers', 'hr_phone_numbers', 'fax_numbers', 'email', 'url', 'working_time', 'update_time', 'user_id', 'branch_name', 'description', 'status', 'wants_placement', 'export_to_yandex', 'postcode', 'type', 'parentID', 'branchParentID','category', 'user'], 'safe'],
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
        $query = Company::find()->with('user')->with('category');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', '_id', $this->_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'legal_form', $this->legal_form])
            ->andFilterWhere(['like', 'legal_name', $this->legal_name])
            ->andFilterWhere(['like', 'sphere', $this->sphere])
            ->andFilterWhere(['like', 'company_size', $this->company_size])
            ->andFilterWhere(['like', 'address_id', $this->address_id])
            ->andFilterWhere(['like', 'address_addition', $this->address_addition])
            ->andFilterWhere(['like', 'phone_numbers', $this->phone_numbers])
            ->andFilterWhere(['like', 'short_phone_numbers', $this->short_phone_numbers])
            ->andFilterWhere(['like', 'hr_phone_numbers', $this->hr_phone_numbers])
            ->andFilterWhere(['like', 'fax_numbers', $this->fax_numbers])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'working_time', $this->working_time])
            ->andFilterWhere(['like', 'update_time', $this->update_time])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'branch_name', $this->branch_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'wants_placement', $this->wants_placement])
            ->andFilterWhere(['like', 'export_to_yandex', $this->export_to_yandex])
            ->andFilterWhere(['like', 'postcode', $this->postcode])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'parentID', $this->parentID])
            ->andFilterWhere(['like', 'branchParentID', $this->branchParentID])
            ->andFilterWhere(['like', 'category.name', $this->category])
            ->andFilterWhere(['like', 'user.name', $this->user]);

        return $dataProvider;
    }
    

}
