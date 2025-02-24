<div class="paginator">
    <?php for($page=1; $page<=$this->pageCount; $page++) { ?>
            <a href="?page=<?echo $page?>" class="link <?echo ($_GET['page']??null) == $page ? 'this' : '' ?>"><?echo $page?></a>
    <? } ?>
</div>