
    public function <?php echo $actionName ?>()
        {

            $pages = new Pagination([
            'pageParam' => 'pageCurrent',
            'pageSizeParam' => 'pageSize',
            'totalCount' =>0,
            'defaultPageSize' => 10
            ]);

            $models=[];
            return $this->render('index', [
            'models' => $models,
            'pages' => $pages
            ]);
         }


//class end
}