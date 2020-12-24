<script>
	$(document).ready(function(){
		$(".sort-heading").click(function(){
			
			//get data-nex-order value
			var getSortHeading = $(this);
			var getNextSortOrder = getSortHeading.attr('id');
			
			var splitID = getNextSortOrder.split('-');
			
			var splitIDName = splitID[0];
			var splitOrder = splitID[1];
			
			//get current td value
			var getColumnName = getSortHeading.text();
			
			$.ajax({
				url:'sort.php',
				type:'POST',
				data:{'column':getColumnName,'sortOrder':splitOrder},
				success: function(response){
					if(splitOrder == 'asc')
					{
						getSortHeading.attr('id',splitIDName+'-desc');
					}
					else
					{
						getSortHeading.attr('id',splitIDName+'-asc');
					}	
					
					$(".table tr:not(:first)").remove();
					$(".table").append(response);
				}
			});
			
		});
	});
</script>
