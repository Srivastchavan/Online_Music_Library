<?php header("Content-type: application/javascript"); ?>
$(document).ready(function () {

   
<?php session_start(); ?>
var UserID = '<?php echo $_SESSION['sess_ID']?>';
var state;	

$.ajax({
      url:"Fav.php",
      method:"GET",
      dataType:"json",
      data:{ "UserID": UserID},

      success: function(entries){

		  
		   state = {
  'imgData': entries,

  'page': 1,
  'rows': 9,
  'window': 5,
};  
displayImages();
populateGenre();
        
	  }
      });
	  
  

function populateGenre() {

$('#filter').html(function() {
    var ret = '<option value="all" selected>Genre</option>',
        u   = state.imgData.slice(),
        arr = [];

    (function get() {
        if (u.length) {
            var v = u.shift();
            if ( $.inArray(v.Genre, arr) == -1 ) {
                arr.push(v.Genre);
                ret += '<option value="' + v.Genre + '">' + v.Genre + '</option>';
            }
            get();
        }
    }());
    
    return ret;
});

    
}
	  


function pagination(imgData, page, rows) {

    var trimStart = (page - 1) * rows
    var trimEnd = trimStart + rows

    var trimmedData = imgData.slice(trimStart, trimEnd)

    var pages = Math.round(imgData.length / rows);

    return {
        'imgData': trimmedData,
        'pages': pages,
    }
}

function pageButtons(pages) {
    var wrapper = document.getElementById('pagination-wrapper')

    wrapper.innerHTML = ''
	console.log('Pages:', pages)

    var maxLeft = (state.page - Math.floor(state.window / 2))
    var maxRight = (state.page + Math.floor(state.window / 2))

    if (maxLeft < 1) {
        maxLeft = 1
        maxRight = state.window
    }

    if (maxRight > pages) {
        maxLeft = pages - (state.window - 1)
        
        if (maxLeft < 1){
        	maxLeft = 1
        }
        maxRight = pages
    }
    
    

    for (var page = maxLeft; page <= maxRight; page++) {
    	wrapper.innerHTML += `<button value=${page} class="page btn btn-sm btn-info">${page}</button>`
    }

    if (state.page != 1) {
        wrapper.innerHTML = `<button value=${1} class="page btn btn-sm btn-info">&#171; First</button>` + wrapper.innerHTML
    }

    if (state.page != pages) {
        wrapper.innerHTML += `<button value=${pages} class="page btn btn-sm btn-info">Last &#187;</button>`
    }

    $('.page').on('click', function() {
        

        state.page = Number($(this).val())
		$('.gallery').empty()
        displayImages()
    })

}


function displayImages() {
    
    var data = pagination(state.imgData, state.page, state.rows)
    var myList = data.imgData

    for (var i = 1 in myList) {
        
		var div = '<div class="col-sm-6 col-lg-4 imgfill '+myList[i].Genre+'"><a href="trackdetails.php?TrackID='+myList[i].TrackID+'"><img src="img/'+myList[i].Pic+'" alt="'+myList[i].Title+'" data-filter-item data-filter-name="'+myList[i].Genre+'" style="width:200px; height:200px;"></a><br/><a href="trackdetails.php?TrackID='+myList[i].TrackID+'">'+myList[i].Title+'</a></div>';
        $('.gallery').append(div);
    }

    pageButtons(data.pages)
}
	
    
function searchFilter()
    {
        
        var search = $('#search').val();
        var filter = $('#filter').val();
        
        $.ajax({
            url:"favsearchfilter.php",
            method:"post",
            dataType:"json",
            data:{ "search": search, "filter" : filter, "UserID": UserID},
            success:function(entries)
            {
              
           state = {
            'imgData': entries,
            'page': 1,
            'rows': 9,
            'window': 5,
            };  
            $('.gallery').empty();
        displayImages();
        populateGenre();
		$('#filter').val(filter);
                $('#search').val(search);
            }
        });
    }

$('#filter').change(function(){
    
    searchFilter();
    
});
$('#btnSearch').on('click', function() {
   
    searchFilter();
    
});

$('#home').on('click', function() {
        $("#track").removeClass('active');
        $("#fav").removeClass('active');
        $("#pricing").removeClass('active');
        $("#acc").removeClass('active');
		
		$("#home").addClass('active');
    });

	$('#track').on('click', function() {
        $("#home").removeClass('active');
        $("#fav").removeClass('active');
        $("#pricing").removeClass('active');
        $("#acc").removeClass('active');
		
		$("#track").addClass('active');
    });
	
	$('#fav').on('click', function() {
        $("#track").removeClass('active');
        $("#home").removeClass('active');
        $("#pricing").removeClass('active');
        $("#acc").removeClass('active');
		
		$("#fav").addClass('active');
    });
	
	
	$('#pricing').on('click', function() {
        $("#track").removeClass('active');
        $("#fav").removeClass('active');
        $("#home").removeClass('active');
        $("#acc").removeClass('active');
		
		$("#pricing").addClass('active');
    });
	
	$('#acc').on('click', function() {
        $("#track").removeClass('active');
        $("#fav").removeClass('active');
        $("#pricing").removeClass('active');
        $("#home").removeClass('active');
		
		$("#acc").addClass('active');
    });
	
	
	  
	  
	  
    });
