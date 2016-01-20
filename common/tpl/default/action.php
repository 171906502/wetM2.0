
    public function <?php echo $actionName ?>()
        {
              $menuId =<?php echo $menuId?>;
              $theadArray = QueryField::find()->where(['menuId'=>$menuId])->asArray()->with('queryTable')->all();
              $tables = QueryTable::find()->where(['menuId'=>$menuId])->asArray()->all();
              $masterTable =$this->getMasterTable($tables);
              if(!$masterTable){
                  $NullPages = new Pagination([
                      'pageParam' => 'pageCurrent',
                      'pageSizeParam' => 'pageSize',
                      'totalCount' => 0,
                      'defaultPageSize' => 20
                  ]);
                  return $this->render('index', [
                      'models' => [],
                      'pages' => $NullPages,
                      'theadArray'=>[]
                  ]);

              }
              $query= (new Query());
              $query->from($masterTable['tabName']);
              $query->select($masterTable['tabName'].'.'.'id');
              foreach($tables as $table){
                  if ($table['isMain']!='1'){
                      $query->leftJoin($table['tabName'],$table['condition']);
                  }
              }
              $attributes=[];
              foreach ($theadArray as $thead){
                  if ($thead['queryTable']['reName']){
                      $addSelect = $thead['queryTable']['reName'];
                  }else{
                      $addSelect = $thead['queryTable']['tabName'];
                  }
                  $addSelect = $addSelect.'.'.$thead['fieldName'];
                  if($thead['makeTbName']!=1){
                      $addSelect=$thead['fieldName'];
                  }
                  if($thead['reName']){
                      array_push($attributes,$thead['reName']);
                      $addSelect = $addSelect.' '.'as'.' '.$thead['reName'];
                  }else{
                      array_push($attributes,$thead['fieldName']);
                  }
                  $query->addSelect($addSelect);

              }
              $pages = new Pagination([
                  'pageParam' => 'pageCurrent',
                  'pageSizeParam' => 'pageSize',
                  'defaultPageSize' => 20
              ]);
              $sort = new WetSort([
                  'attributes' => $attributes,
              ]);
              $provider = new ActiveDataProvider([
                  'query' => $query,
                  'pagination' => $pages,
                  'sort' =>$sort

              ]);
              $models = $provider->getModels();
              return $this->render('index', [
                  'models' => $models,
                  'pages' => $pages,
                  'theadArray'=>$theadArray

              ]);
         }


//class end
}