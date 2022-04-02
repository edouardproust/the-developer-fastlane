            </div>
        </main><!-- /.container -->

        <!-- Footer -->
        <footer class="page-footer font-small mt-5">

            <!-- Footer Text -->
            <div class="container text-center text-md-left py-5">
                <div class="row">
                    <div class="col-md-4">
                        <h5>Counter</h5>
                        <ul class="list-unstyled">
                            <li>
                                <?php 
                                    require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Counter.php'; 
                                    $counter = new Counter(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'page-views');
                                    $counter->increment();
                                    $pageViews = $counter->get_views();
                                    echo "<b>$pageViews</b> page view";
                                    if ($pageViews > 1) { echo "s"; }
                                    echo '<br>— increments by 1';
                                ?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Counter Double</h5>
                        <ul class="list-unstyled">
                            <li>
                                <?php 
                                    require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'CounterDouble.php'; 
                                    $counter = new CounterDouble(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'page-views');
                                    $pageViews = $counter->get_views();
                                    echo "<b>$pageViews</b> page view";
                                    if ($pageViews > 1) { echo "s"; }
                                    echo '<br>— displays 2 times more';
                                ?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Counter 10x</h5>
                        <ul class="list-unstyled">
                            <li>
                                <?php 
                                    require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Counter10x.php'; 
                                    $counter = new Counter10x(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'page-views-10x');
                                    $counter->increment();
                                    $pageViews = $counter->get_views();
                                    echo "<b>$pageViews</b> page view";
                                    if ($pageViews > 1) { echo "s"; }
                                    echo '<br>— increments by 10'
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</html>
