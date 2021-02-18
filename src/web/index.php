<?php
require_once './functions.php';

$airports = require './airports.php';

// Filtering
/**
 * Here you need to check $_GET request if it has any filtering
 * and apply filtering by First Airport Name Letter and/or Airport State
 * (see Filtering tasks 1 and 2 below)
 */

session_start();
if (isset($_GET['filter_by_first_letter'])) {
    $letter = $_GET['filter_by_first_letter'];
    $_SESSION['letter'] = $letter;
    if ($_SESSION['state']) {
        $airports = lookingState($_SESSION['state'], $airports);
    }
    $airports = lookingFirstLetter($letter, $airports);
}

if (isset($_GET['filter_by_state'])) {
    $state = $_GET['filter_by_state'];
    $_SESSION['state'] = $state;
    $airports = lookingState($state, $airports);
    if ($_SESSION['letter']) {
        $airports = lookingFirstLetter($_SESSION['letter'], $airports);
    }
}

// clear all session variables when reset filters
if (!$_GET) {
    $_SESSION = [];
}

// Sorting
/**
 * Here you need to check $_GET request if it has sorting key
 * and apply sorting
 * (see Sorting task below)
 */

if (isset($_GET['sort'])) {
    $sortKey = $_GET['sort'];
    $_SESSION['sort'] = $sortKey;

    // get sorting arrays by column: for letter filter or state filter
    if ($_SESSION['letter']) {
        $airports = lookingFirstLetter($_SESSION['letter'], $airports);
    }
    if ($_SESSION['state']) {
        $airports = lookingState($_SESSION['state'], $airports);
    }
    foreach ($airports as $airport) {
        $sortingArr[] = $airport[$sortKey];
    }

    // sort by using sorting array
    array_multisort($sortingArr, $airports);
}

// Pagination
/**
 * Here you need to check $_GET request if it has pagination key
 * and apply pagination logic
 * (see Pagination task below)
 */

// set qty airports on page
$paged = 5;

// find qty pages
$pages = ceil(count($airports) / $paged);
if (isset($_GET['page'])) :
    $j = $_GET['page'] - 1;
    $offset = $j * $paged;

    // get array for one page
    $airports = array_slice($airports, $offset, $paged);
endif;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Airports</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<main role="main" class="container">

    <h1 class="mt-5">US Airports</h1>

    <!--
        Filtering task #1
        Replace # in HREF attribute so that link follows to the same page with the filter_by_first_letter key
        i.e. /?filter_by_first_letter=A or /?filter_by_first_letter=B

        Make sure, that the logic below also works:
         - when you apply filter_by_first_letter the page should be equal 1
         - when you apply filter_by_first_letter, than filter_by_state (see Filtering task #2) is not reset
           i.e. if you have filter_by_state set you can additionally use filter_by_first_letter
    -->

    <div class="alert alert-dark">
        Filter by first letter:

        <?php foreach (getUniqueFirstLetters(require './airports.php') as $letter): ?>
            <a href="index.php?page=1&filter_by_first_letter=<?= $letter ?>"><?= $letter ?></a>
        <?php endforeach; ?>

        <a href="index.php" class="float-right">Reset all filters</a>
    </div>

    <!--
        Sorting task
        Replace # in HREF so that link follows to the same page with the sort key with the proper sorting value
        i.e. /?sort=name or /?sort=code etc

        Make sure, that the logic below also works:
         - when you apply sorting pagination and filtering are not reset
           i.e. if you already have /?page=2&filter_by_first_letter=A after applying sorting the url should looks like
           /?page=2&filter_by_first_letter=A&sort=name
    -->
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href="index.php?page=1&sort=name">Name</a></th>
            <th scope="col"><a href="index.php?page=1&sort=code">Code</a></th>
            <th scope="col"><a href="index.php?page=1&sort=state">State</a></th>
            <th scope="col"><a href="index.php?page=1&sort=city">City</a></th>
            <th scope="col">Address</th>
            <th scope="col">Timezone</th>
        </tr>
        </thead>
        <tbody>
        <!--
            Filtering task #2
            Replace # in HREF so that link follows to the same page with the filter_by_state key
            i.e. /?filter_by_state=A or /?filter_by_state=B

            Make sure, that the logic below also works:
             - when you apply filter_by_state the page should be equal 1
             - when you apply filter_by_state, than filter_by_first_letter (see Filtering task #1) is not reset
               i.e. if you have filter_by_first_letter set you can additionally use filter_by_state
        -->
        <?php foreach ($airports as $airport): ?>
            <tr>
                <td><?= $airport['name'] ?></td>
                <td><?= $airport['code'] ?></td>
                <td><a href="index.php?page=1&filter_by_state=<?= $airport['state'] ?>"><?= $airport['state'] ?></a></td>
                <td><?= $airport['city'] ?></td>
                <td><?= $airport['address'] ?></td>
                <td><?= $airport['timezone'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!--
        Pagination task
        Replace HTML below so that it shows real pages dependently on number of airports after all filters applied

        Make sure, that the logic below also works:
         - show 5 airports per page
         - use page key (i.e. /?page=1)
         - when you apply pagination - all filters and sorting are not reset
    -->
    <?php if ($_SESSION['letter'] || $_SESSION['state']) { ?>
        <nav aria-label="Navigation">
            <ul class="pagination justify-content-center">
                <?php
                for ($i = 0; $i < $pages; $i++) :
                    $pageNumber = $i + 1;
                    if ($pageNumber == $_GET['page']) {
                        $active = "active";
                    } else {
                        $active = '';
                    }

                    $pageUrl = $pageNumber;
                    if ($_SESSION['letter']) {
                        $pageUrl .= '&filter_by_first_letter=' . $_SESSION['letter'];
                    }
                    if ($_SESSION['state']) {
                        $pageUrl .= '&filter_by_state=' . $_SESSION['state'];
                    }
                    if ($_SESSION['sort']) {
                        $pageUrl .= '&sort=' . $_SESSION['sort'];
                    }

                    ?>

                    <li class="page-item <?= $active ?>"><a class="page-link"
                                                            href="index.php?page=<?= $pageUrl ?>"><?= $pageNumber ?></a>
                    </li>
                <?php endfor ?>
            </ul>
        </nav>
    <?php } ?>

</main>
</html>
