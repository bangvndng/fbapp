<ol>
<?php
 $pagination = $dataProvider->pagination;
 $counter = $dataProvider->totalItemCount - (isset($_GET['page'])?$_GET['page'] - 1:0) * $pagination->limit;
 foreach($dataProvider->getData() as $item): ?>
<li><span><?php echo $counter--; ?></span><a href="<?php echo $this->createUrl('/home/question',array('id' => $item->id)) ?>"><?php echo $item->title ?></a></li>

<?php endforeach; ?>
</ol>


<div class="num_wrap clearfix">
<?php 

class ExtLinkPager extends CLinkPager
{
    protected function createPageButton($label,$page,$class,$hidden,$selected)
    {
    
        if ($selected) return '<li class="now">'.$label.'</li>';
        else
        	return '<li>'.CHtml::link($label,$this->createPageUrl($page)).'</li>';

        return '<li class="'.$class.'">'.'</li>';
    }

    protected function createPageButtons()
    {
            if(($pageCount=$this->getPageCount())<=1)
                    return array();

            list($beginPage,$endPage)=$this->getPageRange();
            $currentPage=$this->getCurrentPage(false); // currentPage is calculated in getPageRange()
            $buttons=array();

            // first page
            if ($beginPage >= 1) {
            	$buttons[]=$this->createPageButton(1,0,$this->firstPageCssClass,$currentPage<=0,false);
            	if ($beginPage > 1) {
            		$buttons[] = '<li class="connect">...</li>';
            	}
            }

            // internal pages
            for($i=$beginPage;$i<=$endPage;++$i)
                    $buttons[]=$this->createPageButton($i+1,$i,$this->internalPageCssClass,false,$i==$currentPage);

		    // last page
            if ($pageCount - 2 >= $endPage) {
            	if ($pageCount - 2 > $endPage) {
            		$buttons[] = '<li class="connect">...</li>';
            	}
            	$buttons[]=$this->createPageButton($pageCount,$pageCount-1,$this->lastPageCssClass,$currentPage>=$pageCount-1,false);

            }

            return $buttons;
    }



}


$this->widget('ExtLinkPager', array(
    'pages' => $pagination,
    'header' => '',
    'htmlOptions' => array('class' => 'num clearfix'),
)) ?>
</div>