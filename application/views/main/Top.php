<body class="v35 webkit <?=$database->bodyClass($_SERVER['HTTP_USER_AGENT']); ?> ar-AE village-2 <?php if($dorf1==''){echo 'perspectiveBuildings';}else{ echo 'perspectiveResources';} ?> <?php echo DIRECTION; ?> buildingsV1">
<script type="text/javascript">
    window.ajaxToken = 'de3768730d5610742b5245daa67b12cd';
</script>
<div id="background">
    <div id="headerBar"></div>
    <div id="bodyWrapper">
        <div id="header">
        <?php
            require_once("application/views/topheader.php");
            require_once("application/views/toolbar.php");
        ?>
        </div>
        <div id="center">
        <?php require_once("application/views/sideinfo.php"); ?>
        <div id="contentOuterContainer" class="size1">
        <?php require_once("application/views/res.php"); ?>
        <div class="contentTitle">
            <a id="closeContentButton" class="contentTitleButton" href="dorf1.php">&nbsp;</a>
            <a id="answersButton" class="contentTitleButton" href="http://t4.answers.travian.com/index.php?aid=106#go2answer" target="_blank">&nbsp;</a>
        </div>

        <div class="contentContainer">
            <div id="content" class="<?php echo $pData['CClass']; ?>">
            <h1 class="titleInHeader"><?php echo $pData['HTitle']; ?></h1>
