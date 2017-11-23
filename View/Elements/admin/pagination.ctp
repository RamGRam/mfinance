<div class="row">
    <div class="col-sm-6">
        <span class="pagination">
        <?php   
	        $rows_per_page = array(10=>10,20=>20,25=>25,50=>50);
	        $links = '';
	        if(!isset($extra)){
	        	$extra=null;
	        }  
	        foreach ($rows_per_page as $rpp) {
	            $links .= $this->Html->tag('li', $this->Html->link($rpp, array('limit' => $rpp, 'page' => 1,'?'=>$extra)));
	        }

	        $limit = '<div class="btn-group">
	            <button data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle" type="button">
	                ' . $this->Paginator->param('limit') . '
	                <span class="caret"></span>
	                <span class="sr-only">Toggle Dropdown</span>
	            </button>
	            <ul role="menu" class="dropdown-menu dropup">
	                ' . $links . '
	            </ul>
	        </div>';
                
	        echo $this->Paginator->counter(array('format' => __('Showing %s records per page, starting {:start} to {:end} of {:count}', $limit)));
        ?>
    	</span>
    </div>
    <div class="col-sm-6">
        <?php echo $this->Paginator->pagination(array('ul' => 'pagination pagination-sm pull-right')); ?>
    </div>
</div>