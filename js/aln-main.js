//from https://stackoverflow.com/questions/17909646/counting-and-limiting-words-in-a-textarea
acf.add_action('ready', function( $el ){
	if(document.getElementById('short-desc-limit')){
		var limit = parseInt(document.getElementById('short-desc-limit').innerHTML);//get limit number
    var usedDisplay = document.getElementById('short-desc-limit-used'); //place to show used
    var countWords = (document.getElementById('acf-field_5ed26754e352d').value) ? document.getElementById('acf-field_5ed26754e352d').value.match(/\S+/g).length : 0;
    var wordsUsed = (countWords > 0) ? countWords:0;
     
    usedDisplay.innerHTML = wordsUsed; 
	}
  jQuery("#acf-field_5ed26754e352d").on('keyup', function() {

    console.log('chh chh changes')
    var words = this.value.match(/\S+/g).length;
    
    if (words > limit) {
      // Split the string on first 200 words and rejoin on spaces
      var trimmed = jQuery(this).val().split(/\s+/, 200).join(" ");
      // Add a space at the end to make sure more typing creates new words
      jQuery(this).val(trimmed + " ");
    }
    else {
      usedDisplay.innerHTML = words;
      //jQuery('#word_left').text(limit-words);
    }
  });
  if (document.getElementById('layout')){
  	document.getElementById('layout').classList.add('hide');
  }
}); 

