// JavaScript Code
var missionText = "Our mission is to spread ideas and inspire action by organizing TED-style events that showcase local voices and elevate them to a global stage.";
document.getElementById("mission-text").innerHTML = missionText;

var teamMembers = [
  {
    name: "Team Member 1",
    image: "team-member-1.jpg"
  },
  {
    name: "Team Member 2",
    image: "team-member-2.jpg"
  },
  {
    name: "Team Member 3",
    image: "team-member-3.jpg"
  },
  // Add more team members here
];

var teamMembersDiv = document.getElementById("team-members");

for (var i = 0; i < teamMembers.length; i++) {
  var teamMember = teamMembers[i];
  var teamMemberDiv = document.createElement("div");
  teamMemberDiv.classList.add("team-member");

  var image = document.createElement("img");
  image.src = teamMember.image;
  image.alt = teamMember.name;
  teamMemberDiv.appendChild(image);

  var name = document.createElement("h3");
  name.innerHTML = teamMember.name;
  teamMemberDiv.appendChild(name);

  teamMembersDiv.appendChild(teamMemberDiv);
}
