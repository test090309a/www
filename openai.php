<?php

// Set the API endpoint URL
$url = 'https://api.openai.com/v1/completions';

// Set your OpenAI API key
$api_key = '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';

// Check if the user has submitted a question
if(isset($_POST['question'])) {

  // Get the question from the form data
  $question = $_POST['question'];

  // Set up the request data
  $data = array(
    'prompt' => $question,
    'temperature' => 0.5,
    'max_tokens' => 100,
    'stop' => '.'
  );

  // Set the HTTP headers
  $headers = array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $api_key
  );

  // Initialize the cURL session
  $curl = curl_init();

  // Set the cURL options
  curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => $headers
  ));

  // Send the HTTP request
  $response = curl_exec($curl);

  // Close the cURL session
  curl_close($curl);

  // Decode the JSON response
  $json_response = json_decode($response, true);

  // Get the generated text from the response
  $answer = $json_response['choices'][0]['text'];

} else {

  // Set a default question
  $question = 'What is the meaning of life?';

  // Set an empty answer
  $answer = '';

}

// Set the content type header to application/json
header('Content-Type: application/json');

// Create an array to hold the response data
$response = array(
  'question' => $question,
  'answer' => $answer
);

// Encode the array as JSON
$json = json_encode($response);

// Output the JSON string
echo $json;

?>

<!DOCTYPE html>
<html>
<head>
  <title>OpenAI API Example</title>
</head>
<body>

  <h1>Ask a Question</h1>

  <form method="POST">
    <label for="question">Question:</label><br>
    <input type="text" id="question" name="question" value="<?php echo $question; ?>"><br>
    <br>
    <input type="submit" value="Ask">
  </form>

  <h2>Answer:</h2>

  <p><?php echo $answer; ?></p>

</body>
</html>
