<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>API Documentation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Blog & CMS API Documentation</h1>

        <div class="space-y-6">
            {{-- Public Routes --}}
            <div>
                <h2 class="text-xl font-semibold mb-2">Public Endpoints</h2>
                <ul class="list-disc ml-6">
                    <li><code>POST</code> /api/register</li>
                    <li><code>POST</code> /api/login</li>
                    <li><code>GET</code> /api/posts</li>
                    <li><code>GET</code> /api/posts/{post}</li>
                </ul>
            </div>

            {{-- Authenticated Routes --}}
            <div>
                <h2 class="text-xl font-semibold mb-2">Authenticated Endpoints <span class="text-sm text-gray-600">(with auth:sanctum)</span></h2>
                <ul class="list-disc ml-6 space-y-2">
                    <li><code>GET</code> /api/me</li>
                    <li><code>POST</code> /api/logout</li>

                    <li><code>POST</code> /api/posts</li>
                    <li><code>PUT</code> /api/posts/{post}</li>
                    <li><code>DELETE</code> /api/posts/{post}</li>

                    <li><code>GET</code> /api/categories</li>
                    <li><code>POST</code> /api/categories</li>
                    <li><code>GET</code> /api/categories/{id}</li>
                    <li><code>PUT</code> /api/categories/{id}</li>
                    <li><code>DELETE</code> /api/categories/{id}</li>

                    <li><code>GET</code> /api/posts/{post}/comments</li>
                    <li><code>POST</code> /api/posts/{post}/comments</li>
                    <li><code>PUT</code> /api/comments/{id}</li>
                    <li><code>DELETE</code> /api/comments/{id}</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
