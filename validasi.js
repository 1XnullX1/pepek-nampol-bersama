// function validateNoId(input) {
//   // Replace any non-numeric characters with an empty string
//   input.value = input.value.replace(/[^0-9]/g, "");

//   // Limit the input to 12 digits
//   if (input.value.length > 25) {
//     input.value = input.value.slice(0, 25);
//   }
// }

function validateAlphabet(input) {
  // Replace any non-alphabetic and non-space characters with an empty string
  input.value = input.value.replace(/[^a-zA-Z\s]/g, "");

  // Limit the input to 50 characters
  if (input.value.length > 50) {
    input.value = input.value.slice(0, 50);
  }
}

function limitTextarea(element, maxLength) {
  if (element.value.length > maxLength) {
    element.value = element.value.slice(0, maxLength);
  }
}
