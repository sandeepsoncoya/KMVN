<?php

if($this->Paginator->params()['pageCount'] > 1):
?>
<ul class="pagination">
    <?php
	    echo $this->Paginator->first(__('First', true), array('tag' => 'li', 'escape' => false,'class'=>'page-item'), array('type' => "button", 'class' => "btn btn-default"));
	    echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false,'class'=>'page-item'), '<a href="#" >&laquo;</a>', array('class' => 'prev disabled page-item', 'tag' => 'li', 'escape' => false));
	    echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a','class'=>'page-item'));
	    echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false,'class'=>'page-item'), '<a href="#" >&raquo;</a>', array('class' => 'prev disabled page-item', 'tag' => 'li', 'escape' => false));
	    echo $this->Paginator->last(__('Last', true), array('tag' => 'li', 'escape' => false,'class'=>'page-item'), array('type' => "button", 'class' => "btn btn-default page-item"));
    ?>
</ul>
<?php endif; ?>
