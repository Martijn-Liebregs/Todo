
// Get action and set onclick
let action_elem = document.getElementsByClassName('addInput');

for(let i = 0; i < action_elem.length; i++){

	action_elem[i].onclick = addInput;
}

// Keep track of number of inputs
count = 0;

// Add input to container
function addInput(){

	// Get clicked element
    let elem = event.target
    
    // Set action
    let action     = elem.getAttribute('href');
    action         = action.replace('#', '');

	// Get id
	let id 	= elem.getAttribute('id');
	id 		= id.replace('action_', '');

	// Get containers
	let cnt  	= document.getElementById('add_task_name'+id);
	let dcnt  	= document.getElementById('add_task_info'+id);
	let tcnt 	= document.getElementById('add_status'+id);	
	let scnt 	= document.getElementById('add_task'+id);	
	let duration = document.getElementById('add_task_duration'+id);			
	let counter = document.getElementById('task_counter'+id);			


			// Create name input
			let input = document.createElement("input");
			// Set attributes
			input.setAttribute('type', 			'text');
			input.setAttribute('name', 			'task_name'+count);
			input.setAttribute('placeholder', 	'Task name '+(count+1));
			// Append element
			cnt.appendChild(input);

			// Create description textarea
			input = document.createElement("textarea");
			// Set attributes
			input.setAttribute('name', 			'task_info'+count);
			input.setAttribute('placeholder', 	'Description '+(count+1));
			input.setAttribute('rows', 			'1');
			// Append element
			dcnt.appendChild(input);

			// Create time input
			input = document.createElement("input");
			// Set attributes
			input.setAttribute('type', 			'text');
			input.setAttribute('name', 			'task_status'+count);
			input.setAttribute('placeholder', 	'Status '+(count+1));
			// Append element
			tcnt.appendChild(input);

			input = document.createElement("input");
			// Set attributes
			input.setAttribute('type', 			'text');
			input.setAttribute('name', 			'task_duration'+count);
			input.setAttribute('placeholder', 	'Duration '+(count+1));
			// Append element
			duration.appendChild(input);

			// Incremenet count
			count++;
			// Incremenet task number
			counter.setAttribute('value', count);

	// Add submit button if there are more than 0 inputs
	if(count == 1) {
		// Create element
		let submit = document.createElement("input");
		// Set attributes
		submit.setAttribute('type', 	'submit');
		submit.setAttribute('value', 	'Add');
		submit.classList.add("button");
		// Append element
		scnt.appendChild(submit);

		// Removes add task button by all other lists
		for(let i = 0; i < action_elem.length; i++){
			// Get id of current element
			let curr_id = action_elem[i].getAttribute('id');
			curr_id 	= curr_id.replace('action_', '');
			// Remove element
			if(curr_id != id){
				action_elem[i].classList.add('hidden');
			}
		}
	}
}
