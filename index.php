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
    if(!parsePOST('term')){
        navigation();
        searchBox();
    }else{
        navigation();
        displayItems(search_item($_POST['term']));
    }
?>
&nbsp
&nbsp
</body>
</html>
