<?php
    include_once 'header.php';
    include_once 'operations.php';
    include_once 'items.php';
    //include 'query.php';
    head('Welcome Page');
?>
<body>
&nbsp

<?php
//searchBox was updated to redirect to a new location
//so the extra logic in the index.php file may not be necessary anymore.
    if(!parsePOST('term')){
        include 'toolbar.php';
        searchBox();
        include 'footer.php';
    }
    //May not be necessary anymore
    else if (parsePOST('term')){
        navigation();
	echo "term case!";
        displayItems(search_item($_POST['term']));
    }
    else if (parsePOST('browse')){
        navigation();
	echo "browse case!";
        displayItems(get_all_items());
    }
?>
&nbsp
&nbsp
</body>
</html>
