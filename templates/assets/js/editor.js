	window.onbeforeunload = function(e) { // Ask before reload page
		return 'Are You sure?';
	};

	// Move Publish Button on scroll
	window.onscroll = function () {
		var element = document.getElementById("publishButton");
		if(window.pageYOffset >= 40) { // 40 is standard margin offset
			element.style.cssText += "margin-left:75%;"; 
		}
		else {
			element.style.cssText += "margin-left:57%;";  
		} 
	}

	// Parse link funtion for detecting needed url
	function checkEmdeded(url) {
		// Detect domain
		var domain = url.split('/')[2] || url.split('/')[0];

		switch(domain) {
			case "www.youtube.com":
				return url.replace("www.youtube.com", "www.youtube.com/embed");
				break;
			/*case "www.facebook.com": // https://www.facebook.com/facebook profile
				return "https://www.facebook.com/plugins/page.php?href=" + encodeURIComponent(url) + "&tabs=timeline&adapt_container_width=true&hide_cover=false&width=1600";
				break;*/
			default:
				// !TODO! Link should be starts with preview.php ... (not quickparseapi.appspot.com)
				return "https://quickparseapi.appspot.com/?url=" + url;
		}
	}

	function showModal(link) {
		// Insert link
		document.getElementById("linkInput").value = link;

		// Update iframe 
		var preview = document.getElementById("linkPreview");
		preview.src = "";
		preview.src = checkEmdeded(link);

		if(!link.includes("quickparseapi.appspot.com")) {
			preview.style.pointerEvents = "all";
		}
		else {
			preview.style.pointerEvents = "none";
		}

		// Show modal
		document.getElementById('publishButton').style.display = 'none';

		var modal = document.getElementById('link');
		modal.style.display = "block";
		modal.style.visibility = "visible";
	}

	function hideModal(cancelFlag) {
		document.getElementById('publishButton').style.display = 'block';
		document.getElementById("titleInput").value = "";

		if(cancelFlag) { // Remove link
			var firstLink = document.getElementById('firstLink').value;
			var id = document.getElementById('elementID').value;
			var p = document.getElementById(id);  

			var text = p.innerHTML;
			p.innerHTML = text.replace(firstLink, "");
		}

		var modal = document.getElementById('link');
		modal.style.width = "100%";
		modal.style.height = "100%";
		modal.style.position = "absolute";
		modal.style.visibility = "hidden";
		modal.style.display = "none";
		modal.style.backgroundColor = "rgba(22,22,22,0.5)";
	}

			// Show/Hide link preview
			function previewButtonCliked(element) {
				if(element.checked) {
					// Load preview into iframe
					var preview = document.getElementById("linkPreview");
					var link = checkEmdeded(document.getElementById("linkInput").value);
					preview.src = link;

					if(!link.includes("quickparseapi.appspot.com")) {
						preview.style.pointerEvents = "all";
					}
					else {
						preview.style.pointerEvents = "none";
					}

					// Load preview into iframe     !TODO! Link should be starts with preview.php ... (not quickparseapi.appspot.com)
					//document.getElementById("linkPreview").src = "https://quickparseapi.appspot.com/?url=" + document.getElementById("linkInput").value;

					// Setup preview caption text
					//document.getElementById("previewCaption").innerText = "Preview is enabled";

					// Setup close button position
					$("#linkClose").animate({ marginTop: "-0.5%" }, 'slow');

					// Disable tooltip
					document.getElementById("previewToolTip").style.display = "none";

					// Set position for "Add" button
					document.getElementById("completeLink").style.width = "65%";

					// Set Size for Title and Link inputs
					$("#linkFields").animate({ marginRight: "65%" });

					// Animate modal frame resizing
					$("#linkModal").animate({ width: "45%", height: "40%", top: "20%" }, 'slow').promise().then(function() { 
						// Show iframe window
						document.getElementById("linkPreview").style.display = "block" ;
					});             
				}
				else {
					// Setup preview caption text
					//document.getElementById("previewCaption").innerText = "Preview is disabled";

					// Setup close button position
					$("#linkClose").animate({ marginTop: "0.5%" }, 'slow');

					// Set position for "Add" button         
					$("#completeLink").animate({ marginRight: "-22%" }, 'fast').promise().then(function() { 
						document.getElementById("completeLink").style.width = "60%";

						// Enable tooltip back
						document.getElementById("previewToolTip").style.display = "block";
					});

					// Hide iframe window
					document.getElementById("linkPreview").style.display = "none";

					// Set Size for Title and Link inputs
					$("#linkFields").animate({ marginRight: "16%" });

					// Animate modal frame resizing    
					$("#linkModal").animate({ width: "25%", height: "40%", top: "25%" }, 'slow');      
				}
		}

	$(document).ready(function()  {
		// Uncheck preview check box if checked
		var checkbox = document.getElementById('previewCheckBox');
		if(checkbox.checked) {
			checkbox.checked = false;
		}

		// Finnaly add link
		document.getElementById('completeLink').addEventListener('click', function() {         
			if(document.addLinkForm.reportValidity()) {
				var link = document.getElementById('linkInput').value.replace(/(^\w+:|^)\/\//, '');
				var firstLink = document.getElementById('firstLink').value;
				var id = document.getElementById('elementID').value;
				var title = document.getElementById('titleInput').value;      
				var p = document.getElementById(id);   
				var text = p.innerHTML;
				var previewLink = checkEmdeded(firstLink);

				if(document.getElementById('linkPreview').style.display == "block") { // preview type 
					// Create new iFrame element     
					newIframe(p.parentNode.nextSibling, previewLink, title);

					// Remove link from text
					p.innerHTML = text.replace(firstLink, "");
				}
				else { // text type
					content = "<a href='#' style='color: #125cb8' onclick='openShortUrl(\"" + link + "\"); return false;'>" + title + "</a>"; // class='previewLink'
					
					// On hover preview
					//content += "<div class='previewBox'><iframe class='previewFrame' src='" + previewLink + "'></iframe></div>";

					// Replace link in text with content data
					p.innerHTML = text.replace(firstLink, content);             
				}   
				
				// Remove whitespaces
				//p.innerText = p.innerText.trim();

				// Remove free p tag 
				if(p.innerText.trim() === "") {
					p.parentNode.parentNode.removeChild(p.parentNode);
				}

				// Close modal window
				hideModal(false);
			}    
		});
	});

		// iFrameTemplate
		/*const iFrameTemplate = ({ url, title, pointer }) => `
		<div style='width:480px; height:320px; position:relative; margin-left: auto;margin-right: auto;'>
		<a style='text-decoration:none !important; z-index:3 !important; position: absolute; right: 15px; color:#125cb8; margin-top: 10px;' class='' onclick='removeIframe(this.parentNode.parentNode);'>✖</a>
			<iframe class='previewFrame' style='pointer-events: ${pointer}' src='${url}'></iframe>        
		</div>
		<center data-text="Title here" style='margin-left: calc(50% - 120px); margin-right: calc(50% - 120px); color:#125cb8' contenteditable>${title}</center>
		<br/>`;*/

		// iFrameTemplate NEW (Polaroid effect)
		const iFrameTemplate = ({ url, title, pointer }) => `  
		<div style='width:480px; height:320px; position:relative; margin-left: auto;margin-right: auto;' class="polaroid"> 
			<a style='text-decoration:none !important; z-index:3 !important; position: absolute; right: 15px; color:#125cb8; margin-top: 10px;' class='' onclick='removeIframe(this.parentNode.parentNode);'>✖</a>
			<iframe class='previewFrame' style='pointer-events: ${pointer}' src='${url}'></iframe>
			<div class="container">
				<center data-text="Title here" style='margin-left: calc(50% - 120px); margin-right: calc(50% - 120px); color:#125cb8' contenteditable>${title}</center>
			</div>  
		</div>
		<center data-text="Title here" style='margin-top: -10px; margin-left: calc(50% - 120px); margin-right: calc(50% - 120px); color:#125cb8' contenteditable>${title}</center> 
		<br/>`;

	// Simple paragraph template
	const paragraphTemplate = ({ text, id }) => `
		<p id="p${id}" contenteditable align="justify" class="text article" style="position:relative;" onkeyup="detectUrl(this); paragraphKeyUp(this)" data-placeholder="Continue here...">${text}</p>
		<i class="fa fa-picture-o content-menu" style="margin-top:-35px; margin-left:20%;" onclick="ShowContentMenu(this.parentNode.id, 0);"></i>`

	// Image Template
	const ImageTemplate = ({ id }) => `
		<div class="polaroid">        
			<a style='text-decoration:none !important; position: absolute; right: 15px; color:white; margin-top: 10px;' class='' onclick='removeImage(\"image${id}\");'>✖</a>
			<img width='100%' height='auto' id='img${id}'></img>   
			<div class="container">
				<div id='imgtitle${id}' data-text="Title here" style='margin-left: 25%; margin-right: 25%; color:#125cb8' contenteditable></div>
			</div>     
		</div>
		<br/>`;

	function newParagraph(text, newID, afterID) { 
		// Create text container
		var div = document.createElement('div');
		div.id = "paragraph" + newID;
		div.classList.add("paragraphDiv");
		div.classList.add("row");

		// Insert template into container
		div.innerHTML = [{ text: text, id: newID }].map(paragraphTemplate).join('');

		// Insert container with text after choosed id
		var parent = document.getElementById('articleParent'); 
		//parent.insertBefore(div, document.getElementById(afterID).nextSibling);
		parent.insertBefore(div, afterID);
	}

	// Add new paragraph if current not free
	function paragraphKeyUp(p) {
			var curId = p.id.substr(1);
			var nextId = parseInt(curId) + 1;
			nextParagraph = document.getElementById('paragraph' + nextId); 
	
			if(p.innerText === "") {
				 if (nextParagraph && nextParagraph.innerText === "") {
					nextParagraph.parentNode.removeChild(nextParagraph);
				 }
			}
			else if (!nextParagraph) {       
				newParagraph("", nextId, document.getElementById("paragraph" + curId).nextSibling);
			}
	}

	// Add image from template to article content block
	function newImage(curId, afterID, title, src) {
		//Create image container
		var div = document.createElement('div');
		div.id = "image" + curId;
		div.style.display = "none";
		div.classList.add("imageDiv");

		// Insert template into container
		div.innerHTML = [{ id: curId }].map(ImageTemplate).join('');

		// Show image container
		div.style.display = "block";

		// Insert container with text after choosed id
		var parent = document.getElementById('articleParent'); 
		//parent.insertBefore(div, document.getElementById(afterID).nextSibling);
		parent.insertBefore(div, afterID);

		// Get img tag
		var img = document.getElementById('img' + curId);

		// Load image into img tag
		img.src = src;

		// Set title
		document.getElementById('imgtitle' + curId).innerText = title;
	}

	// Add iFrame from template to article content block
	function newIframe(afterID, link, title) {
		 // Create iframe container
		 var div = document.createElement('div');
		 div.classList.add("iframeDiv");

		 // Detect embeded 
		 var pointer = "";
		 if(!link.includes("quickparseapi.appspot.com")) {
			 pointer = "all";
		 }
		 else {
			 pointer = "none";
		 }

		 // Insert iframe into container
		 div.innerHTML = [{ url: link, title: title, pointer: pointer }].map(iFrameTemplate).join('');

		 // Insert container with iframe after current p tag
		 var parent = document.getElementById('articleParent');         
		parent.insertBefore(div, afterID);
		 //parent.insertBefore(div, document.getElementById(afterID).nextSibling);
		 //parent.insertBefore(div, p.parentNode.nextSibling);

		 return div.nextSibling;
	}

	 // Content menu - add photo / link
	function ShowContentMenu(curId, id) {
		if(id == 0) {
			// Getting id
			curId = parseInt(curId.substring(9));

			// Create image container
			var div = document.createElement('div');
			div.id = "image" + curId;
			div.style.display = "none";
			div.classList.add("imageDiv");

			// Insert template into container
			div.innerHTML = [{ id: curId }].map(ImageTemplate).join('');

			// Insert container with text after choosed id
			var parent = document.getElementById('articleParent'); 
			parent.insertBefore(div, document.getElementById("paragraph" + curId).nextSibling);

			// Call image picker dialog
			var imagePicker = document.getElementById('imagePicker');
			imagePicker.alt = curId;    
			imagePicker.click();
		}
		/*else if(id == 1) {
			alert("Add link menu");
		}*/  
	}

	// Load image into image container 
	function onImageSelected(event) {
		var imagePicker = document.getElementById('imagePicker');
		
		if(imagePicker.value != "") {
			// Getting first selected image
			var selectedFile = event.target.files[0];
			var reader = new FileReader();

			// Getting needed settings for inserting image into container
			var id = parseInt(document.getElementById('imagePicker').alt);
			var container = document.getElementById('image' + id);
			var img = document.getElementById('img' + id);
			img.title = selectedFile.name;

			reader.onload = function(event) {
				// Load image into img tag
				img.src = event.target.result;

				// Show container
				container.style.display = "block";

				// Show new paragraph
				newParagraph("", id + 1, document.getElementById("image" + id).nextSibling);

				// Remove current paragpraph if free
				var p = document.getElementById('p' + id);
				if (p && p.innerText === "") {
					p.parentNode.parentNode.removeChild(p.parentNode);
				}

				// Clear image picker             
				imagePicker.value = "";
				imagePicker.dispatchEvent(new Event('change'));
			};

			// Load image
			reader.readAsDataURL(selectedFile);
		}
	}

	// Remove image container by id
	function removeImage(id) {
		var image = document.getElementById(id);
		image.parentNode.removeChild(image);
	}

	// Remove iFrame container by element.paretNode
	function removeIframe(element) {
		element.parentNode.removeChild(element);
	}

		// Get cursor position inside p tag
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

		// Set cursor position inside p tag
		function setSelectionRange(input, selectionStart, selectionEnd) {
			if (input.setSelectionRange) {
			  input.focus();
			  input.setSelectionRange(selectionStart, selectionEnd);
			}
			else if (input.createTextRange) {
			  var range = input.createTextRange();
			  range.collapse(true);
			  range.moveEnd('character', selectionEnd);
			  range.moveStart('character', selectionStart);
			  range.select();
			}
		  }
		  
		function setCaretToPos (input, pos) {
			setSelectionRange(input, pos, pos);
		}*/

		function getCaretPosition(element)
		{
			var ie = (typeof document.selection != "undefined" && document.selection.type != "Control") && true;
			var w3 = (typeof window.getSelection != "undefined") && true;
			var caretOffset = 0;
			if (w3)
			{
				var range = window.getSelection().getRangeAt(0);
				var preCaretRange = range.cloneRange();
				preCaretRange.selectNodeContents(element);
				preCaretRange.setEnd(range.endContainer, range.endOffset);
				caretOffset = preCaretRange.toString().length;
			}
			else if (ie)
			{
				var textRange = document.selection.createRange();
				var preCaretTextRange = document.body.createTextRange();
				preCaretTextRange.expand(element);
				preCaretTextRange.setEndPoint("EndToEnd", textRange);
				caretOffset = preCaretTextRange.text.length;
			}
			return caretOffset;
		}

		// Set cursor position inside p tag
		function setCaretPos(el, sPos)
		{
			/*range = document.createRange();                    
			range.setStart(el.firstChild, sPos);
			range.setEnd  (el.firstChild, sPos);*/
			var charIndex = 0, range = document.createRange();
				range.setStart(el, 0);
				range.collapse(true);
				var nodeStack = [el], node, foundStart = false, stop = false;
		
				while (!stop && (node = nodeStack.pop())) {
					if (node.nodeType == 3) {
						var nextCharIndex = charIndex + node.length;
						if (!foundStart && sPos >= charIndex && sPos <= nextCharIndex) {
							range.setStart(node, sPos - charIndex);
							foundStart = true;
						}
						if (foundStart && sPos >= charIndex && sPos <= nextCharIndex) {
							range.setEnd(node, sPos - charIndex);
							stop = true;
						}
						charIndex = nextCharIndex;
					} else {
						var i = node.childNodes.length;
						while (i--) {
							nodeStack.push(node.childNodes[i]);
						}
					}
				}
			selection = window.getSelection();                 
			selection.removeAllRanges();                       
			selection.addRange(range);
		}    

		// Url detection function
		function detectUrl(element) {
			if(element) {
				// Took id of sender element
				var id = element.id;
	
				var key = window.event.keyCode;
				if (key == 32 || key == 13) {
					// Link detection
					var p = document.getElementById(id);
					var text = p.innerText;
	
					var regex = /https:\/\/[\-A-Za-z0-9+&@#\/%?=~_|$!:,.;]*[\s|\r\n|\n|\r]+/g; // /https?:\/\/[\-A-Za-z0-9+&@#\/%?=~_|$!:,.;]*[\s|\r\n|\n|\r]+/g; to allow http
					var link = regex.exec(text);
	
					if(link) { // text.match(regex)
						link = link[0].trim();
	
						// Save p tag id
						document.getElementById('elementID').value = id;
						document.getElementById('firstLink').value = link;
						
						// Show menu for link processing
						showModal(link);
					}    


					// Hashtag and usernames detection
					var pos = getCaretPosition(p);
					var newHTML = p.innerHTML.replace(/#(\w+)/g, " #$1 ").replace(/@(\w+)/g, " @$1 ");
					newHTML = newHTML.replace(/ +#(\w+) /g, "<a class='hashtag' style='text-decoration:none !important; color:rgb(18,92,184);' href='#' onclick='openHashtag(this.innerText)'>$1</a>");
					newHTML = newHTML.replace(/ +@(\w+) /g, "<a class='username' style='text-decoration:none !important; color:rgb(238,73,87)' href='#' onclick='openUserLink(this.innerText)'>$1</a>");
					if(newHTML !== p.innerHTML) {
						p.innerHTML = newHTML;
						setCaretPos(p, pos - 1);         
					}

					//p.innerHTML = p.innerHTML.replace(/@(\w+)/g, "<a style='text-decoration:none !important; color:#125cb8;' href='#' onclick='openUserLink(\"$1\")'>@$1</a>");
					//console.log(p.innerHTML);
					
					// Hashtag and usernames detection (color: #EE4957)
				   /*var newHTML = p.innerHTML.replace(/#(\w+)/g, "<a style='text-decoration:none !important; color:#125cb8;' href='#' onclick='openHashtag(this.innerText)'>#$1</a>").replace(/@(\w+)/g, "<a style='text-decoration:none !important; color:#125cb8;' href='#' onclick='openUserLink(this.innerText)'>@$1</a>");
					if(newHTML != p.innerHTML) {
						console.log("replace");
						console.log("$" + newHTML + "$");
						console.log("$" + p.innerHTML + "$");
						p.innerHTML = newHTML;
					}*/
				}
			}
		}

	// Open url by short link by adding https
	function openShortUrl(link) {
		window.open("https://" + link, '_blank').focus();
	}

	// Start hashtag search
	function openHashtag(tag) {
		alert('MYRM hashtag search: \"' + tag + '\"');
		//window.open("https://" + tag, '_blank').focus();
	}

	// Open user page
	function openUserLink(username) {
		alert('Open \"' + username + '\" page on MYRM');
		//window.open("https://" + username, '_blank').focus();
	}

	// Pre-load events binding
	$(document).ready(function()  {
		// Load article saved data on page loading
		try {
			if (typeof(Storage) !== "undefined") {
				if ((title = localStorage.getItem('title')) !== null && title !== "undefined") {
					$('#title').val(title);
				}
		
				if ((author = localStorage.getItem('author')) !== null && author !== "undefined") {
					$('#author').val(author);
				}
				
				if ((content = localStorage.getItem('content')) !== null && content !== "undefined") {             
					// { type: "paragraphDiv", data: text, id: id }
					// { type: "imageDiv", data: image, title: title, id: id }
					// { type: "iframeDiv", data: link, title: title }

					// Get content array
					content = JSON.parse(content);

					// Set afterID variable
					var afterID = document.getElementById("paragraph0").nextSibling;
  
					// Parse content array
					content.forEach(function(element) {
						var type = element["type"];

						switch(type) {
							case "paragraphDiv": // Paragraph text
								if(element["id"] === "p0") { // already exists by default
									document.getElementById("p0").innerHTML = element["data"];
								}
								else { // new one
									var id = parseInt(element["id"].substr(1));
									newParagraph(element["data"], id, afterID);
									afterID = document.getElementById("paragraph" + id).nextSibling;
								}
								break;
							case "imageDiv": // Image
								var id = parseInt(element["id"].substr(3));
								newImage(id, afterID, element["title"], element["data"])
								afterID = document.getElementById("image" + id).nextSibling;
								break;
							case "iframeDiv": // iFrame preview
								afterID = newIframe(afterID, element["data"], element["title"]);                
								break;
						}
					});
				}
			}
		} catch (error) {
			console.log(error);
		}

		// Autosave article on text change event
		setInterval(function() { 
			var list = getArticleContent(); // JSON.stringify(list)
			//console.log(list);
		
			// Save all
			localStorage.setItem('title', $('#title').val()); 
			localStorage.setItem('author', $('#author').val()); 
			localStorage.setItem('content', JSON.stringify(list)); 

			}, 3000);

		// Autosave article on text change event
		/*$(title).bind("keydown", function() {           
			localStorage.setItem('title', $('#title').val());
		});*/

		/*$(document).bind("keydown", function() { 
			console.log("autosave");
		});*/
	});

	 // Parse article content into one list
	 function getArticleContent() {
		// 1) Paragraph: div id="paragraph0" with p id="p0" with innerHTML value
		// 2) Image: div id="image1" with div with img id="img1" with src value
		// 3) iFrame: div class="iframeDiv" 
		//                                  3.1) with div with iframe with src value
		//                                  3.2) with center with innerText value

		var list = [];   
		$('#articleParent > div').each(function () { // Select all divs in articleParent 
			var div = $(this)[0];
			
			switch (true) {
				case div.className.startsWith('paragraphDiv'):
					// Get text of paragraph
					var p = div.getElementsByTagName('p')[0];
					var text = p.innerHTML;
					var id = p.id;

					// Append paragraph data to article elements array
					list.push({type: "paragraphDiv", data: text, id: id}); 

					break;
				case div.className.startsWith('imageDiv'):
					// Get image and title
					var img = div.getElementsByTagName('img')[0];
					var image = img.src;
					var id = img.id;

					var title = div.getElementsByTagName('div')[0].getElementsByTagName('div')[0].innerText;
					
					// Append paragraph data to article elements array
					list.push({type: "imageDiv", data: image, title: title, id: id}); 
					
					break;
				case div.className.startsWith('iframeDiv'):
					// Get link and title    
					var iframe = div.getElementsByTagName('div')[0].getElementsByTagName('iframe')[0];     
					var link = iframe.src;
					//var pointer = iframe.style.pointerEvents;

					var title = div.getElementsByTagName('center')[0].innerText;

					// Append paragraph data to article elements array
					list.push({type: "iframeDiv", data: link, title: title}); // , pointer: pointer
					
					break;
			}
		});

		return list;
	}

// Article publish function
function publish() {
	if(document.publishForm.reportValidity()) {
		var dataJSON = { title: $('#title').val(), author: $('#author').val(), content: getArticleContent() };
		//console.log(JSON.stringify(data));
		// Send data list to server
		alert(dataJSON);
		$.ajax({
			type: 'POST',
			url: '/api/editor_Publish/',
			data: {
				'data': dataJSON,
			},
			success: function(data){
				alert(data);
				console.log(data);
				//location.href(data);
			},
			error: function(){
				alert('error!');
			},

		});
		//alert("Send data to server");
	}
	// if empty - style add "box-shadow:0 0 5px 1px #1A81D4;"
	// if not empty - style add "box-shadow:none;"
}