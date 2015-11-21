<?php require_once("login_success.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>gylt</title>
        <!--<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.gridster/0.5.6/jquery.gridster.min.css">-->
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.min.css" />
        <link rel="stylesheet" href="styles/testgrid.css" />
        <link rel="stylesheet" href="styles/style.css" />
        <!--<link rel="stylesheet" href="styles/gridster.css" />-->
        <link rel="stylesheet" href="styles/slidepanel.css" />

    </head>

    <body>
        <header>
            <nav>
                <ul id="menu-container">
                    <li class="menu-btn" id="hello-user">hello <?php if (isset($_SESSION['first_name'])) {echo $_SESSION['first_name'];} ?></li>
                    <li class="menu-btn" id="logo"><a href="index.php" class="menu-link" id="nav-home">gylt</a></li>
                    <li class="menu-btn" id="designs-menu-btn"><a href="" class="menu-link" id="nav-designs">designs</a></li>
                    <li class="menu-btn" id="account-menu-btn"><a href="account.php" class="menu-link" id="nav-account">account</a></li>
                    <li class="menu-btn" id="signout-menu-btn"><a href="logout.php" class="menu-link" id="nav-signout">sign out</a></li>
                </ul>
            </nav>
        </header>

        <div id="workspace">

        </div><!--end workspace-->

        <div id="right-panel" draggable="true">
            <h3 id="right-panel-title">Editing Panel</h3>
            <ul>
                <li id="add-components">
                    <input type="checkbox" id="add-components-checkbox" checked>
                    <label class="panel-section-title" for="add-components-checkbox"><i></i>Add Components</label>
                    <div class="panel-section">
                        <div class="add-item">
                            <h4>Blank Box</h4>
                            <input type="text" id="dimension-x-box"/>
                            x
                            <input type="text" id="dimension-y-box"/>
                            <button id="add-rectangle">Add Box</button>
                        </div>
                        <div class="add-item">
                            <h4>List Box</h4>
                            <input type="text" id="list-length"/> &#35; lines
                            <button id="add-list">Add List</button>
                        </div>
                        <button class="add-schedule-button" id="add-month">Add Month</button>
                        <button class="add-schedule-button" id="add-week">Add Week</button>
                        <button class="add-schedule-button" id="add-day">Add Day</button>
                        <button class="add-schedule-button" id="delete-selected">Delete Selected</button>
                    </div><!--end panel-section-->
                </li><!--end add-components-->

                <li id="design-components">
                    <input type="checkbox" id="design-components-checkbox">
                    <label class="panel-section-title" for="design-components-checkbox"><i></i>Design Components</label>
                    <div class="panel-section">
                        <div class="design-attributes">Background Color: <input class="jscolor" id="background-color" value="FFFFFF"></div>
                        <div class="design-attributes">Border Width: 
                            <select id="border-width">
                                <option>1px</option>
                                <option>2px</option>
                                <option>3px</option>
                            </select>
                        </div>
                        <div class="design-attributes">Border Color: <input class="jscolor" id="border-color" value="B5B5B5"></div>
                        <div class="design-attributes">Font Family: 
                            <select id="font-family">
                                <option value="Avenir">Avenir</option>
                                <option value="Helvetica">Helvetica</option>
                                <option value="Times New Roman">PT Serif</option>
                                <option value="Garamond">Mate</option>
                            </select>
                        </div>
                        <div class="design-attributes">Font Size: 
                            <select id="font-size">
                                <option>0.75em</option>
                                <option>1em</option>
                                <option>1.25em</option>
                            </select>
                        </div>
                    </div><!--end panel-section-->
                </li><!--end design-components-->
                <li>
                    <input type="checkbox" id="save-preview-print-checkbox">
                    <label class="panel-section-title" for="save-preview-print-checkbox"><i></i></label>
                    <div class="panel-section">
                        <button class="save-preview-print-button" id="save-button">Save</button>
                        <button class="save-preview-print-button" id="preview-button">Preview</button>
                        <button class="save-preview-print-button" id="print-button">Print</button>
                    </div>
                </li>
                    
            </ul>
            
        </div><!--end right-panel-->

        <div class="cd-panel is-visible from-right">
            <header class="cd-panel-header">
                <div id="panel-header-content">Designs</div>
                <a href="#0" class="cd-panel-close">Close</a>
            </header>
         
            <div class="cd-panel-container">
                <div class="cd-panel-content">
                    <ul id="panel-designs-list">
                        <li>Design 1</li>
                        <li>Design 2</li>
                        <li>Design 3</li>
                    </ul>
                </div> <!-- end cd-panel-content -->
            </div> <!-- end cd-panel-container -->
        </div> <!-- end cd-panel -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.gridster/0.5.6/jquery.gridster.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.5.3/less.min.js"></script>-->
        <script src="scripts/jscolor-2.0.4/jscolor.min.js"></script>
        

        <script src="scripts/app.js"></script>
        <!--<script src="scripts/gridster.js"></script>-->
        <!--<script src="scripts/drag.js"></script>-->
        <script src="scripts/capture_workspace.js"></script>
        <script src="scripts/testgrid.js"></script>

        <!-- <script src="script/print.jquery"></script> -->

    </body>
</html>