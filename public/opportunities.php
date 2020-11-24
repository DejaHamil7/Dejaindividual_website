<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Abundant Futures</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"></script>
    <link href="style.css" rel="stylesheet">
</head>
<body>

    <!--Navigation -->
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
<div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="C:\logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarResponsive"> 
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="scholarships.html">Scholarships</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="opportunities.html">Opportunities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="vocational.html">Vocational Schools</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tuitionFree.html">Tuition Free</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ContactUs.html">Contact Us</a>
                </li>

            </ul>
        </div>
</div>
</nav>

<?php 
require_once "C:\careerjet_jobs\Careerjet_API.php" ;

$api = new Careerjet_API('en_US') ;
$page = 1 ; # Or from parameters.

$result = $api->search(array(
  'keywords' => 'php developer',
  'location' => 'Baltimore',
  'page' => $page ,
  'affid' => '678bdee048',
));

if ( $result->type == 'JOBS' ){
  echo "Found ".$result->hits." jobs" ;
  echo " on ".$result->pages." pages\n" ;
  $jobs = $result->jobs ;
  
  foreach( $jobs as $job ){
    echo " URL:     ".$job->url."\n" ;
    echo " TITLE:   ".$job->title."\n" ;
    echo " LOC:     ".$job->locations."\n";
    echo " COMPANY: ".$job->company."\n" ;
    echo " SALARY:  ".$job->salary."\n" ;
    echo " DATE:    ".$job->date."\n" ;
    echo " DESC:    ".$job->description."\n" ;
    echo "\n" ;
  }

  # Basic paging code
  if( $page > 1 ){
    echo "Use \$page - 1 to link to previous page\n";
  }
  echo "You are on page $page\n" ;
  if ( $page < $result->pages ){
    echo "Use \$page + 1 to link to next page\n" ;
  }
}

# When location is ambiguous
if ( $result->type == 'LOCATIONS' ){
  $locations = $result->solveLocations ;
  foreach ( $locations as $loc ){
    echo $loc->name."\n" ; # For end user display
    ## Use $loc->location_id when making next search call
    ## as 'location_id' parameter
  }
}

?>


</body>
</html>