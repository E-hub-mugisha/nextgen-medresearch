<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Project Message</title>
</head>

<body style="font-family: Arial, sans-serif; background:#f9fafb; padding:20px;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" style="background:#ffffff; border-radius:8px; padding:20px;">
                    <tr>
                        <td>
                            <h2 style="color:#111827; margin-bottom:5px;">
                                New Message Received
                            </h2>

                            <p style="color:#6b7280; margin-top:0;">
                                You have received a new message regarding the project below.
                            </p>

                            <hr>

                            <p><strong>Project Title:</strong><br>
                                {{ $projectTitle }}
                            </p>

                            <p><strong>From:</strong><br>
                                {{ $sender->name }} ({{ $sender->email }})
                            </p>

                            <p><strong>Message:</strong></p>

                            <div style="background:#f3f4f6; padding:15px; border-left:4px solid #4f46e5;">
                                {{ $messageBody }}
                            </div>

                            <p style="margin-top:20px;">
                                Please log in to your account to respond to this message.
                            </p>

                            <a href="{{ url('/messages') }}"
                                style="display:inline-block;margin-top:15px;
                               background:#4f46e5;color:#ffffff;
                               padding:10px 18px;text-decoration:none;
                               border-radius:5px;">
                                View Messages
                            </a>

                            <hr style="margin-top:30px;">

                            <p style="font-size:12px;color:#9ca3af;">
                                This message was sent automatically from {{ config('app.name') }}.
                                Please do not reply directly to this email.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>