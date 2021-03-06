$(function () {
$("#tourLink").click(function () {
	if (typeof tour === 'undefined') {
    // the variable is undefined
		console.log("undefined");
		var tour = new Tour({
		name: "welcome",
		steps: [
		{
			title: "Welcome to EarthMates!",
			content: "There a couple things to learn before you get up and running, so let's check those out!",
			orphan: true
		},
		{
			element: "#profile",
			title: "Your Profile",
			content: "This is your profile, which contains all your personal information."
		},
		{
			element: "#profile-panel",
			title: "First Steps",
			content: "You'll notice that before you can begin using EarthMates, there are a few things you have to do."
		},
		{
			element: "#quiz",
			title: "Self-Assessment",
			content: "The first thing you'll want to do is establish your self-awareness by taking a quiz. This is a critical first step."
		},
		{
			element: "#invite",
			title: "Invite Someone",
			content: "Next, you'll want to invite someone to take a similar assessment of your behavior."
		},
		{
			element: "#dropdown-toggle",
			title: "Next Steps",
			content: "After you've done these two things, you'll be able to access your scores in this dropdown menu.",
			backdropContainer: 'nav',
				placement: 'left'
		},
		{
			element: "#dropdown-toggle",
			title: "Next Steps",
			content: "The goal is to get more than just one person reviewing you so you have a diverse profile to learn from.",
			backdropContainer: 'nav',
				placement: 'left'
		},
		{
			title: "Next Steps",
			content: "Thanks for being a part of the EarthMates experiment!",
			orphan: true
		}],
		storage: false,
		backdrop: true
		});

		// Initialize the tour
		tour.init();
		
		// Start the tour
		tour.start();
	}
});
});