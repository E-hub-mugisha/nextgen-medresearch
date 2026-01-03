<h2>New Contact Form Submission</h2>
<h1>Hello Admin,</h1>

<p>You have received a new message from the contact form on your website. Here are the details:</p>
<p><strong>First Name:</strong> {{ $data['fname'] }}</p>
<p><strong>Last Name:</strong> {{ $data['lname'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>
<p><strong>Phone:</strong> {{ $data['phone'] }}</p>
<p><strong>Message:</strong></p>
<p>{{ $data['message'] }}</p>

<p>Looking forward to connecting with you soon.</p>
<p>Regards,<br>{{ $data['fname'] }} {{ $data['lname'] }}</p>