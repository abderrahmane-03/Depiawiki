<?php

interface ITag {
    function insert(Tag $Tag);
    function edit(Tag $Tag);
    function delete($TagId);
    function display();
    function getTagsForWiki($wikiId);
    function associateTagWithWiki($tagId, $wikiId);
    function countTag();
}
?>