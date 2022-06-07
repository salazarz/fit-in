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

$("#predict-button").click(async function () {
	if (!modelLoaded) { alert("The model must be loaded first"); return; }
	if (!imageLoaded) { alert("Please select an image first"); return; }

	let image = $('#selected-image').get(0);

	// Pre-process the image
	console.log("Loading image...");
	let tensor = tf.browser.fromPixels(image, 3)
		.resizeNearestNeighbor([128, 128]) // change the image size
		.expandDims()
		.toFloat();
	let predictions = await model.predict(tensor).data();
	let score = tf.tensor1d(predictions).softmax();
	// score.softmax().print();
	score.data().then((d) => {
		// console.log(d)
		let top5 = Array.from(d)
			.map(function (p, i) { // this is Array.map
				return {
					probability: p,
					className: TARGET_CLASSES[i] // we are selecting the value from the obj
				};
			}).sort(function (a, b) {
				return b.probability - a.probability;
			}).slice(0, 4);

		$("#prediction-list").empty();
		top5.forEach(function (p) {
			$("#prediction-list").append(`<li>${p.className}: ${p.probability.toFixed(6)*100}%</li>`);
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