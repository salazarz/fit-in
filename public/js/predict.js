let model;
let modelLoaded = false;
$(document).ready(async function () {
	modelLoaded = false;
	$('.progress').show();
	console.log("Loading model...");
	// model = await tf.loadLayersModel('https://github.com/salazarz/fit-in/blob/main/public/model/model.json');
	model = await tf.loadGraphModel('model/model.json');
	console.log("Model loaded.");
	$('.progress').hide();
	modelLoaded = true;
});

function generateRandom(min, max) {
    let difference = max - min;
    let rand = Math.random();

    rand = Math.floor( rand * difference);
    rand = rand + min;

    return rand;
}


$("#predict-button").click(async function () {
	if (!modelLoaded) { alert("The model must be loaded first"); return; }
	if (!imageLoaded) { alert("Please select an image first"); return; }

	let image = $('#selected-image').get(0);

	let tensor = tf.browser.fromPixels(image, 3)
		.resizeNearestNeighbor([128, 128]) // change the image size
		.expandDims()
		.toFloat();
	let predictions = await model.predict(tensor).data();
	let score = tf.tensor1d(predictions).softmax();
	score.data().then((d) => {
		let top5 = Array.from(d)
			.map(function (p, i) {
				return {
					probability: p,
					className: TARGET_CLASSES[i]
				};
			}).sort(function (a, b) {
				return b.probability - a.probability;
			}).slice(0, 1);

		$("#prediction-list").empty();
		
		top5.forEach(function (p) {
			if (p.probability.toFixed(3)*100 >= 70){
				if (p.className == "sate"){
					let cal = generateRandom(375, 452)
					$("#prediction-list").append(`<li class="pb-5">${p.className}: ${cal} cal</li>`);
					$("#prediction-list").append(`<input type="hidden" name="food" value="${p.className}">`);
					$("#prediction-list").append(`<input type="hidden" name="calories" value="${cal}">`);
				}else if (p.className == "gado"){
					let cal = generateRandom(318, 353)
					$("#prediction-list").append(`<li class="pb-5">${p.className}: ${cal} cal</li>`);
					$("#prediction-list").append(`<input type="hidden" name="food" value="${p.className}">`);
					$("#prediction-list").append(`<input type="hidden" name="calories" value="${cal}">`);
				}else if (p.className == "rendang"){
					let cal = generateRandom(354, 432)
					$("#prediction-list").append(`<li class="pb-5">${p.className}: ${cal} cal</li>`);
					$("#prediction-list").append(`<input type="hidden" name="food" value="${p.className}">`);
					$("#prediction-list").append(`<input type="hidden" name="calories" value="${cal}">`);
				}else if (p.className == "bakso"){
					let cal = generateRandom(325, 368)
					$("#prediction-list").append(`<li class="pb-5">${p.className}: ${cal} cal</li>`);
					$("#prediction-list").append(`<input type="hidden" name="food" value="${p.className}">`);
					$("#prediction-list").append(`<input type="hidden" name="calories" value="${cal}">`);
				}
				$("#prediction-list").append(`<button type="submit" id="add-button" class="rounded-md bg-green-600 px-5 py-2 text-white">Add Food</button>`);
			}else{
				alert("foto tidak jelas. mohon input kembali");
			}
			// $("#prediction-list").append(`<li>${p.className}: ${p.probability.toFixed(3)*100}%</li>`);
		});
	})
	// console.log(predictions);
	// console.log(score.softmax().data());
	// console.log(score.argMax().data());
	// console.log(predictions[0]);
});

TARGET_CLASSES = {
	0: "bakso",
	1: "gado",
	2: "rendang",
	3: "sate",
};