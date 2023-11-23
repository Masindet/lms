<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Userbook;

/**
 * UserbookSearch represents the model behind the search form of `common\models\Userbook`.
 */
class UserbookSearch extends Userbook
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userBookId', 'userId', 'bookId'], 'integer'],
            [['issuedDate', 'returnDate', 'dueDate', 'status'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search($params, $userId)
    {
        $query = Userbook::find()->where(['userId' => $userId]);

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
            'userBookId' => $this->userBookId,
            'userId' => $this->userId,
            'bookId' => $this->bookId,
            'issuedDate' => $this->issuedDate,
            'returnDate' => $this->returnDate,
            'dueDate' => $this->dueDate,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
