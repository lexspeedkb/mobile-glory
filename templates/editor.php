    <meta name="author" content="starkdmi">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Article</title>
    
    <!-- Icons link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,400i,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
        
    <!-- jQuery from server -->
    <!--<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.6.4/jquery.contextMenu.min.js"></script>-->

    <!-- jQuery from server -->
    <!-- <script src="js/jquery-1.11.0.js"></script> -->
    <script src="/templates/assets/js/content-menu.js"></script>

    <!-- Main javascript and styles files -->
    <link rel="stylesheet" href="/templates/assets/css/editor.css?v=1.3">
    <script src="/templates/assets/js/editor.js?v=1.3"></script>

    <!-- Add support old IE for custom tag -->
    <!--[if lt IE 9]> 
        <script> document.createElement("myarticle"); </script>
    <![endif]-->

<style>
    /* Custom tag for article text */
    /*myarticle{
        display:block;
    }*/


    /* Text styling context menu BEGIN */
    /*ul.tools {
    display: none;
    list-style: none;
    box-shadow: 0px 0px 4px rgba(0,0,0,.5);
    border: solid 1px #000;
    position: absolute;
    background: #fff;
    }

    ul.tools li {
        display: inline-block;
        width: 10px;
        height: 20px;
        border: solid 1px #000;
        margin: 5px;
        padding: 5px 10px;
        cursor: pointer;
    }*/
    /* Text styling context menu END */

    



        /* Preview box styles BEGIN */
        /*.previewBox{
            display: none;
            width: 100%;
        }
        
        .previewLink:hover + .previewBox, .previewBox:hover{
            display: block;
            position: relative;
            z-index: 100;
        }*/
        /* Preview box styles END */
</style>

<script>
    // Temporary
    $(document).ready(function()  {
        /*var p = document.getElementById('p0');
        p.innerHTML = `Lorem ipsum dolor sit amet, 
            <a class='username' style='text-decoration:none !important; color:#EE4957' href='#' onclick='openUserLink(this.innerText)'>username</a>
            consectetur adipiscing elit, 
            <a class='hashtag' style='text-decoration:none !important; color:#125cb8;' href='#' onclick='openHashtag(this.innerText)'>hashtag</a>
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
            <a href='#' style='color: #125cb8' onclick='alert(\"Open link in new tab\"); return false;'>link</a>
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 
            https://vk.com`;      

        p.dispatchEvent(new Event('keyup'));*/

        
    });
</script>

<body>

    <input style="display:none;" onchange="onImageSelected(event)" id="imagePicker" type="file" accept="image/*;capture=camera">

    <form name="addLinkForm" id="addLinkForm">
        <!-- Page modal popup menu for links setup -->
        <div id="link">
            <div id="linkModal" class="reveal-modal" style="min-height: 250px;">
               
                <!-- Close button -->
                <a id="linkClose" style="text-decoration:none !important; position: absolute; color:#125cb8; margin-top: 0.5%;" class="close-reveal-modal" onclick="hideModal(true);">✖</a>

                <!-- Title -->
                <center><h1 style="margin-top: -2%; color:#125cb8">Link</h1></center>

                <!-- Link preview iframe -->
                <iframe id="linkPreview" class="frame" scrolling="no"></iframe>

                <!-- Input fields -->
                <div id="linkFields" style="margin-left: 0%; margin-right: 16%;">
                    <input id="elementID" style="display:none">
                    <input id="firstLink" style="display:none">
                    <input id="titleInput" class="roundInput" type="text" size="40" placeholder="Title" pattern="[a-zA-Z0-9 ]+" title="Title should contain only letters and spaces" required>
                    <input id="linkInput" class="roundInput" type="url" placeholder="Link" required>

                    <!-- Preview caption -->
                    <!--<font style="font-size:16pt; color:#125cb8; margin-top: -10%;vertical-align: middle;">Preview</font>-->

                    <!-- Toggle switch button for choosing preview options -->
                    <label class="switch tooltip">   
                        <input id="previewCheckBox" type="checkbox" onclick="previewButtonCliked(this);">            
                        <span class="slider round"><!--<span class="on">ON</span><span class="off">OFF</span>--><!--<div id="previewCaption" style="margin-left: 70px;margin-top:10%;color:#125cb8">Preview is disabled</div>--></span>     
                        
                        <span id="previewToolTip" class="tooltiptext">Tap to enable preview</span>
                    </label>           

                    <button type="button" id="completeLink" style="float:right; margin-right: -22%; margin-top: -1%; width: 60%">Done</button>

                 </div>

                </br></br> 

                <!-- Add link button -->
                <!--<button id="completeLink" onclick="completeLink();" style="float:right; margin-right: -2%; margin-top: -32%; width: 50%">Done</button>-->
                        
            </div>
        </div>
    </form>

    <form name="publishForm" id="publishForm">
        <div id="articleParent">
            <!-- Publish button -->
            <button type="button" id="publishButton" onclick="publish();" style="position: fixed; top: 13%; margin-left: 57%;">Publish</button>

            <!-- Article title -->
            <input id="title" type="text" placeholder="Title" class="text title" maxlength="24" pattern="[a-zA-Z ]+" title="Title should contain only letters and spaces" required>
            <br/>

            <!-- Article author -->
            <input id="author" type="text" placeholder="Your name" class="text author" maxlength="24" pattern="[a-zA-Z ]+" title="Name should contain only letters and spaces" required>

            <!-- Content section -->
            <div class="paragraphDiv row" id="paragraph0"> <!-- Article text group -->  
                <!-- Text input field -->  
                <p id="p0" align="justify" class="text article" style="position:relative;" onkeyup="detectUrl(this); paragraphKeyUp(this)" onselect="//restyleMenu();" data-placeholder="Type here..." contenteditable></p>

                <!-- Content menu buttons  -->
                <i class="fa fa-picture-o content-menu" style="margin-top:-35px; margin-left:20%;" onclick="ShowContentMenu(this.parentNode.id, 0);"></i>
                <!--<i class="fa fa-link content-menu" style="margin-left:21%;" onclick="ShowContentMenu(1);"></i>-->             
            </div>




            <br/>
            <br/>


            <!-- <myarticle id="article2">Type here...</myarticle> -->

            <!-- Context text style menu -->
            <!--<ul class="tools">
                <li>1</li>
                <li>2</li>
                <li>3</li>
            </ul>-->


        
        </div>
    </form>	

    <script>
        // Remove HTML tags from string
        function strip(str) {
            var tmp = document.createElement("div");
            tmp.innerHTML = str;
            return tmp.textContent || tmp.innerText || "";
        }

        // Get all article tags for modification
        var pTags = document.querySelector("p[contenteditable]");

        // Reset style of pasted text
        pTags.addEventListener("paste", function(e) {
            e.preventDefault();
            var text = e.clipboardData.getData("text/plain");
            document.execCommand("insertHTML", false, strip(text));
        });






        // Context text style menu
        /*function getCaretPosition (node) {
            var range = window.getSelection().getRangeAt(0),
                preCaretRange = range.cloneRange(),
                caretPosition,
                tmp = document.createElement("div");

            preCaretRange.selectNodeContents(node);
            preCaretRange.setEnd(range.endContainer, range.endOffset);
            tmp.appendChild(preCaretRange.cloneContents());
            caretPosition = tmp.innerHTML.length;
            return caretPosition;
        }

       $(document).ready(function() {
            $(document).bind("mouseup", function() {
                var selectedText = window.getSelection() || document.getSelection() || document.selection.createRange().text;
                if(selectedText != ''){
                    oRect = selectedText.getRangeAt(0).getBoundingClientRect(); 

                    console.log(getCaretPosition(document.getElementById('p1')));

                    $('ul.tools').css({
                        'left': oRect.x,
                        'top' : oRect.y - 65
                    }).fadeIn(200);
                } else {
                    $('ul.tools').fadeOut(200);
                }
            });
        });*/

        // Show text design menu on text selection
       /*pTags.addEventListener("mouseup", function(e) {
            e.preventDefault();
            var selection = window.getSelection();
            var text = selection.toString();
            if (text != '') {
                // Show menu
                //alert('Show context menu');
                
                // Apply new style to selected text
                // Paste <span class="STYLE NEEDED"> before SELECTED TEXT
                // And </span> after SELECTED TEXT

                // <b>bold</b> and <i>italic</i>
            }
            else {
                // Hide menu
            }
        });*/

        // Detect context menu position
        /*pTags.addEventListener("mousedown", function(e){
            pageX = e.pageX;
            pageY = e.pageY;
        });*/

    </script>

</body>