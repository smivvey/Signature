<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signature'])) {
  // Retrieve the signature image data from the form submission
  $signatureImage = $_POST['signature'];

  // Prepare the email content
  $to = 'your-email@example.com'; // Set the recipient email address
  $subject = 'Signature Submission'; // Set the email subject
  $message = 'A signature has been submitted.'; // Set the email body

  // Set the email headers
  $headers = 'From: Your Website <no-reply@example.com>' . "\r\n";
  $headers .= 'Reply-To: ' . $to . "\r\n";
  $headers .= 'Content-Type: text/plain; charset=UTF-8' . "\r\n";

  // Attach the signature image to the email
  $attachment = chunk_split(base64_encode($signatureImage));
  $headers .= 'Content-Disposition: attachment; filename="signature.png"' . "\r\n";
  $headers .= 'Content-Transfer-Encoding: base64' . "\r\n";
  $headers .= 'X-Attachment-Id: ' . rand(1000, 99999) . "\r\n";
  $headers .= "\r\n";
  $headers .= $attachment . "\r\n";

  // Send the email
  $success = mail($to, $subject, $message, $headers);

  // Check if the email was sent successfully
  if ($success) {
    // Return a success response
    echo json_encode(['status' => 'success', 'message' => 'Signature submitted successfully.']);
  } else {
    // Return an error response
    echo json_encode(['status' => 'error', 'message' => 'Error submitting the signature. Please try again.']);
  }
}
?>
