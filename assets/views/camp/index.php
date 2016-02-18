<div ng-controller="indexController" style="color: black;">
    <div class="row">
        <div class="large-3 columns">
            <!-- logo -->
            Logo
        </div>
        <div class="large-9 columns">
            <a class="inside" ng-click="create()" role="button">camp create</a>
        </div>
    </div>

    <!-- First Band (Image) -->
    <div class="row">
        <div class="large-12 columns">
            <?php
            foreach ( $myCampInfo as $row ) {
                echo "<div>$row</div>";
            }
            ?>
        </div>
    </div>

    <!-- Second Band (Image Left with Text) -->

    <div class="row">
        <div class="large-4 columns">
            <!-- left image -->
            Image
        </div>
        <div class="large-8 columns">
            <!-- text content -->
            Text
        </div>
    </div>

    <!-- Third Band (Image Right with Text) -->

    <div class="row">
        <div class="large-8 columns">
            <!-- text content -->
            Text
        </div>
        <div class="large-4 columns">
            <!-- right image -->
            Image
        </div>
    </div>

    <!-- Footer -->

    <footer class="row">
        <div class="large-12 columns">
            <div class="row">
                <div class="large-6 columns">
                    <!-- copyright -->
                    copyright
                </div>
                <div class="large-6 columns">
                    <!-- footer links -->
                    footer
                </div>
            </div>
        </div>
    </footer>
</div>