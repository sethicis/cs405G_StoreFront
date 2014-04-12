<?php
    include 'header.php';
    include 'operations.php';
    include 'items.php';
    include 'query.php';
    head('Welcome Page');
?>
<body>
&nbsp

<?php
    $isn = '23kk2';
    header("Location: item.php?isn=" . $isn . "&error=qty");
    /*if(!parsePOST('term')){
        navigation();
        searchBox();
    }
    else if (parsePOST('term')){
        navigation();
	echo "term case!";
        displayItems(search_item($_POST['term']));
    }
    else if (parsePOST('browse')){
        navigation();
	echo "browse case!";
        displayItems(get_all_items());
    }*/
?>
&nbsp
&nbsp
</body>
</html>
