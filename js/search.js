var page = 0, rows, resultsPerPage, pageCount;
$(document).ready(function() {
	if (results)
	{
		results = JSON.parse(results);
		resultsPerPage = 5;
		pageCount = Math.floor(results.length / resultsPerPage);
	
		rows = $(".search-table>tbody>tr");
	
		$(".previous>a").disable(true);
		if(results.length <= 5) 
				$(".next>a").disable(true);
			
		$(".previous>a").on('click', loadPrevious);
		$(".next>a").on('click', loadNext);
	}
});

function loadPrevious()
{
	$(".previous>a").disable(true);
	$(".next>a").disable(true);
	
	if(page > 0)
	{
		page--;
		var start = page * resultsPerPage;
		
		console.log(page);
		console.log(start);
		
		rows.empty();
		
		for (var i = 0; i < rows.length; i++)
		{
			var profile = results[start+i];
			var html = "";
			html += "<td>";
			html += '<img src="img/anonymous.png" class="img-responsive" />';
			html += '</td>';
			if (parseInt(profile.GlobalProfile))
			{
				html += '<td><a href="view_profile.php?id=' + profile.ID + '">' + profile.FirstName + " " + profile.LastName + '</a></td>';
				html += '<td class="results-score">' + (profile.AvgScore ? profile.AvgScore.toFixed(1) : 'N/A' ) + '</td>';
				html += '<td><a class="btn btn-default" role="button" href="view_profile.php?id=' + profile.ID + '">Link</a></td>';	
			}
			else
			{
				html += '<td title="This user does not allow others to view their EarthMates profile.">' + profile.FirstName + " " + profile.LastName + '</td>';
				html += '<td title="This user does not allow others to view their EarthMates profile.">N/A</td>';
				html += '<td><a class="btn btn-default" disabled="disabled" href="#" role="button" title="This user does not allow others to view their EarthMates profile.">Link</a></td>';
			}
			
			rows[i].innerHTML = html;
		}
		
		// Reset page navigators
		if (page > 0) {
			$(".previous>a").disable(false);
		}
		$(".next>a").disable(false);
	}
}

function loadNext() 
{
	$(".previous>a").disable(true);
	$(".next>a").disable(true);
	
	if(page < pageCount)
	{
		page++;
		var start = page * resultsPerPage, end;
		
		if (start + rows.length <= results.length)
			end = rows.length;
		else
			end = results.length - start;
		
		console.log(page);
		console.log(start);
		console.log(end);
		
		rows.empty();
		
		for (var i = 0; i < end; i++)
		{
			var profile = results[start+i];
			var html = "";
			html += "<td>";
			html += '<img src="img/anonymous.png" class="img-responsive" />';
			html += '</td>';
			if (parseInt(profile.GlobalProfile))
			{
				html += '<td><a href="view_profile.php?id=' + profile.ID + '">' + profile.FirstName + " " + profile.LastName + '</a></td>';
				html += '<td class="results-score">' + (profile.AvgScore ? profile.AvgScore.toFixed(1) : 'N/A' ) + '</td>';
				html += '<td><a class="btn btn-default" role="button" href="view_profile.php?id=' + profile.ID + '">Link</a></td>';	
			}
			else
			{
				html += '<td title="This user does not allow others to view their EarthMates profile.">' + profile.FirstName + " " + profile.LastName + '</td>';
				html += '<td title="This user does not allow others to view their EarthMates profile.">N/A</td>';
				html += '<td><a class="btn btn-default" disabled="disabled" href="#" role="button" title="This user does not allow others to view their EarthMates profile.">Link</a></td>';
			}
			
			rows[i].innerHTML = html;
		}
		
		// Reset page navigators
		if (page < pageCount)
		{
			$(".next>a").disable(false);
		}
		$(".previous>a").disable(false);
	}
}

jQuery.fn.extend({
    disable: function(state) {
        return this.each(function() {
            this.disabled = state;
        });
    }
});