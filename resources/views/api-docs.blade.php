<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IClick API Docs</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      color-scheme: dark;
      font-family: 'Inter', sans-serif;
      background: #05060d;
      color: #eef4ff;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      min-height: 100vh;
      background: radial-gradient(circle at top left, rgba(72, 170, 255, 0.12), transparent 20%),
                  radial-gradient(circle at bottom right, rgba(158, 81, 255, 0.16), transparent 18%),
                  linear-gradient(180deg, #070a14 0%, #080b16 40%, #04050a 100%);
    }

    .page-shell {
      display: grid;
      grid-template-columns: 320px minmax(0, 1fr);
      gap: 24px;
      max-width: 1480px;
      margin: 0 auto;
      padding: 32px;
    }

    .sidebar {
      position: sticky;
      top: 26px;
      align-self: start;
      padding: 30px;
      border-radius: 28px;
      background: rgba(12, 18, 34, 0.94);
      border: 1px solid rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(26px);
      box-shadow: 0 36px 100px rgba(0, 0, 0, 0.22);
    }

    .sidebar h2 {
      margin: 0 0 10px;
      font-size: 1.55rem;
      letter-spacing: -0.03em;
    }

    .sidebar p {
      margin: 0 0 30px;
      color: #9aa7bf;
      line-height: 1.82;
    }

    .endpoint-list {
      list-style: none;
      padding: 0;
      margin: 0;
      display: grid;
      gap: 14px;
    }

    .endpoint-link {
      padding: 18px 20px;
      border-radius: 22px;
      background: rgba(255, 255, 255, 0.03);
      border: 1px solid rgba(255, 255, 255, 0.08);
      transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease;
      cursor: pointer;
      display: grid;
      gap: 6px;
    }

    .endpoint-link:hover {
      transform: translateY(-1px);
      background: rgba(255, 255, 255, 0.06);
      border-color: rgba(95, 148, 255, 0.2);
    }

    .endpoint-link.active {
      background: linear-gradient(135deg, rgba(72, 190, 255, 0.14), rgba(120, 85, 255, 0.16));
      border-color: rgba(97, 169, 255, 0.28);
    }

    .endpoint-link span {
      display: block;
      color: #b3c2db;
      font-size: 0.95rem;
    }

    .endpoint-name {
      font-size: 1rem;
      font-weight: 700;
      color: #f5f9ff;
    }

    .endpoint-method {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 0.82rem;
      font-weight: 700;
      letter-spacing: 0.04em;
      padding: 0.65em 0.95em;
      border-radius: 999px;
      text-transform: uppercase;
    }

    .method-post { background: rgba(58, 181, 118, 0.16); color: #a4ffd4; border: 1px solid rgba(58, 181, 118, 0.24); }
    .method-get { background: rgba(81, 145, 255, 0.16); color: #bae0ff; border: 1px solid rgba(81, 145, 255, 0.24); }

    .main-panel {
      display: grid;
      gap: 22px;
    }

    .hero-card,
    .info-card,
    .panel-card,
    .try-card {
      padding: 32px;
      border-radius: 26px;
      background: rgba(11, 16, 29, 0.92);
      border: 1px solid rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(28px);
      box-shadow: 0 32px 86px rgba(0, 0, 0, 0.24);
    }

    .hero-top {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 18px;
      align-items: center;
    }

    .hero-top h1 {
      margin: 0;
      font-size: clamp(2rem, 2.3vw, 2.5rem);
      letter-spacing: -0.05em;
    }

    .hero-top .subtitle {
      max-width: 720px;
      margin: 0;
      color: #b8c4dc;
      line-height: 1.7;
    }

    .endpoint-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      align-items: center;
      margin-top: 18px;
    }

    .endpoint-meta span {
      display: inline-flex;
      align-items: center;
      border-radius: 16px;
      padding: 0.8em 1em;
      font-size: 0.9rem;
      font-weight: 600;
      color: #dbe6ff;
      background: rgba(255, 255, 255, 0.04);
      border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .card-title {
      margin: 0 0 16px;
      font-size: 1.18rem;
      font-weight: 700;
      color: #f8fbff;
    }

    .card-label {
      margin: 0 0 10px;
      color: #9da8c8;
      font-size: 0.94rem;
    }

    .section-grid {
      display: grid;
      gap: 22px;
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .section-card {
      padding: 26px;
      border-radius: 22px;
      background: rgba(14, 19, 34, 0.92);
      border: 1px solid rgba(255, 255, 255, 0.06);
    }

    .section-card h3 {
      margin: 0 0 14px;
      font-size: 1rem;
      color: #f4f9ff;
    }

    .section-card p {
      margin: 0;
      color: #b3bfd5;
      line-height: 1.75;
      font-size: 0.95rem;
    }

    .code-box {
      position: relative;
      border-radius: 20px;
      overflow: hidden;
      background: #020915;
      border: 1px solid rgba(255, 255, 255, 0.08);
      box-shadow: inset 0 0 0 1px rgba(255,255,255,0.02);
      min-height: 220px;
      display: flex;
      flex-direction: column;
    }

    .code-box pre {
      margin: 0;
      padding: 22px;
      overflow-x: auto;
      font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;
      font-size: 0.92rem;
      line-height: 1.75;
      color: #91d7ff;
      background: linear-gradient(180deg, rgba(10, 16, 28, 0.96), rgba(6, 10, 20, 0.96));
      white-space: pre-wrap;
      word-break: break-word;
      flex: 1;
    }

    .code-toolbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 10px;
      padding: 14px 18px;
      background: rgba(255, 255, 255, 0.04);
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .code-toolbar span {
      font-size: 0.92rem;
      color: #99aac8;
    }

    .copy-button {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.7em 1em;
      border-radius: 14px;
      border: none;
      outline: none;
      cursor: pointer;
      font-size: 0.9rem;
      font-weight: 600;
      color: #eff6ff;
      background: rgba(64, 146, 255, 0.18);
      transition: transform 0.2s ease, background 0.2s ease;
    }

    .copy-button:hover {
      transform: translateY(-1px);
      background: rgba(64, 146, 255, 0.3);
    }

    .try-card {
      display: grid;
      gap: 24px;
    }

    .try-grid {
      display: grid;
      gap: 18px;
      grid-template-columns: 1fr 1fr;
    }

    .form-field {
      display: grid;
      gap: 10px;
    }

    .form-field label {
      color: #a8b3cc;
      font-size: 0.92rem;
    }

    .form-field input,
    .form-field textarea {
      width: 100%;
      border: 1px solid rgba(255, 255, 255, 0.12);
      background: rgba(255, 255, 255, 0.05);
      color: #eef4ff;
      border-radius: 16px;
      padding: 16px 18px;
      font-size: 1rem;
      outline: none;
      transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
      backdrop-filter: blur(12px);
    }

    .form-field textarea {
      min-height: 120px;
      resize: vertical;
    }

    .form-field input::placeholder,
    .form-field textarea::placeholder {
      color: rgba(255, 255, 255, 0.45);
    }

    .form-field input:focus,
    .form-field textarea:focus {
      border-color: #58c4ff;
      box-shadow: 0 0 0 4px rgba(77, 155, 255, 0.14);
      transform: translateY(-1px);
    }

    .submit-row {
      display: flex;
      flex-wrap: wrap;
      gap: 16px;
      align-items: center;
      justify-content: space-between;
    }

    .status-pill {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.95em 1.2em;
      border-radius: 999px;
      font-size: 0.95rem;
      font-weight: 700;
      color: #edf8ff;
      background: rgba(129, 226, 255, 0.15);
      border: 1px solid rgba(106, 202, 255, 0.22);
    }

    .status-pill.error {
      background: rgba(255, 102, 141, 0.16);
      border-color: rgba(255, 115, 122, 0.24);
      color: #ffd6dc;
    }

    .status-pill.success {
      background: rgba(94, 235, 127, 0.16);
      border-color: rgba(114, 228, 136, 0.24);
      color: #e7ffe6;
    }

    .send-button {
      border: none;
      outline: none;
      border-radius: 18px;
      padding: 16px 28px;
      background: linear-gradient(135deg, #5fc3ff 0%, #7f58ff 100%);
      color: #fff;
      font-size: 1rem;
      font-weight: 700;
      letter-spacing: 0.01em;
      cursor: pointer;
      box-shadow: 0 18px 44px rgba(74, 121, 255, 0.25);
      transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
    }

    .send-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 22px 52px rgba(74, 121, 255, 0.28);
    }

    .send-button:disabled {
      opacity: 0.65;
      cursor: not-allowed;
      box-shadow: none;
      transform: none;
    }

    .note {
      margin: 0;
      color: #8e9ecb;
      font-size: 0.94rem;
      line-height: 1.7;
    }

    .file-preview {
      position: relative;
      overflow: hidden;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      padding: 14px;
      display: grid;
      gap: 12px;
    }

    .file-preview img {
      width: 100%;
      max-height: 240px;
      object-fit: contain;
      border-radius: 18px;
      border: 1px solid rgba(255,255,255,0.08);
      background: rgba(0,0,0,0.15);
    }

    .file-preview span {
      color: #c7d4ea;
      font-size: 0.95rem;
    }

    code {
      font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', 'Courier New', monospace;
      color: #cde9ff;
      background: rgba(255, 255, 255, 0.05);
      padding: 0.2em 0.45em;
      border-radius: 8px;
    }

    @media (max-width: 1024px) {
      .page-shell {
        grid-template-columns: 1fr;
      }
      .sidebar {
        position: static;
        top: auto;
      }
      .section-grid,
      .try-grid {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 660px) {
      .hero-top,
      .submit-row,
      .endpoint-meta {
        flex-direction: column;
        align-items: stretch;
      }
      .send-button {
        width: 100%;
      }
    }

    .footer-container {
      max-width: 1480px;
      margin: 0 auto 32px;
      padding: 22px 32px;
      border-radius: 24px;
      background: rgba(11, 16, 29, 0.9);
      border: 1px solid rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(28px);
      box-shadow: 0 28px 72px rgba(0, 0, 0, 0.16);
      display: flex;
      flex-wrap: wrap;
      gap: 18px;
      align-items: center;
      justify-content: space-between;
    }

    .footer-credit {
      color: #c0d0ee;
      font-size: 0.95rem;
      letter-spacing: 0.01em;
    }

    .footer-credit strong {
      color: #ffffff;
    }

    .footer-links {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
    }

    .social-link {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 42px;
      height: 42px;
      border-radius: 14px;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.08);
      color: #c1d2f6;
      text-decoration: none;
      transition: transform 0.2s ease, background 0.2s ease, color 0.2s ease;
    }

    .social-link:hover {
      transform: translateY(-2px);
      background: rgba(95, 148, 255, 0.18);
      color: #ffffff;
    }

    .social-link svg {
      width: 18px;
      height: 18px;
      fill: currentColor;
    }
  </style>
</head>
<body>
  <div class="page-shell">
    <aside class="sidebar">
      <h2>IClick API</h2>
      <p>Developer portal for IClick API. Browse docs, inspect JSON payloads, and test endpoints using a premium SaaS-style interface.</p>

      <ul class="endpoint-list">
        <li class="endpoint-link active" data-endpoint="verifyotp">
          <span class="endpoint-name">Send OTP</span>
          <span>POST /api/verifyotp</span>
        </li>
        <li class="endpoint-link" data-endpoint="signup">
          <span class="endpoint-name">Signup</span>
          <span>POST /api/signup</span>
        </li>
        <li class="endpoint-link" data-endpoint="signin">
          <span class="endpoint-name">Sign In</span>
          <span>POST /api/signin</span>
        </li>
        <li class="endpoint-link" data-endpoint="getmyprofile">
          <span class="endpoint-name">Get My Profile</span>
          <span>GET /api/getmyprofile</span>
        </li>
        <li class="endpoint-link" data-endpoint="getposts">
          <span class="endpoint-name">Get Posts</span>
          <span>GET /api/getposts</span>
        </li>
        <li class="endpoint-link" data-endpoint="uploadpost">
          <span class="endpoint-name">Upload Post</span>
          <span>POST /api/uploadpost</span>
        </li>
      </ul>
    </aside>

    <main class="main-panel">
      <section class="hero-card">
        <div class="hero-top">
          <div>
            <h1>API documentation</h1>
            <p class="subtitle">A modern developer portal for IClick API. View endpoints, inspect schema samples, and execute live requests from a polished SaaS-style dashboard.</p>
          </div>
          <div id="methodBadge" class="endpoint-method method-post">POST</div>
        </div>

        <div class="endpoint-meta">
          <span id="endpointPath">https://iclickapi-main-vfl3rp.free.laravel.cloud/api/verifyotp</span>
          <span id="endpointStatus">Live</span>
        </div>
      </section>

      <section class="info-card section-grid">
        <article class="section-card">
          <h3>Description</h3>
          <p id="endpointDescription" class="note">Send OTP to user's email for authentication. Use this endpoint to start the login flow with a one-time password.</p>
        </article>
        <article class="section-card">
          <h3>How it works</h3>
          <p class="note">Each endpoint includes schema previews, auth support, a live request panel, and a developer console-style response viewer.</p>
        </article>
      </section>

      <section class="panel-card section-grid">
        <article class="section-card">
          <div class="card-title">Request</div>
          <div class="code-box">
            <div class="code-toolbar">
              <span>Request schema</span>
              <button class="copy-button" type="button" data-copy="requestSample">Copy</button>
            </div>
            <pre id="requestSample">{
  "firstname": "string",
  "email": "string"
}</pre>
          </div>
        </article>

        <article class="section-card">
          <div class="card-title">Response</div>
          <div class="code-box">
            <div class="code-toolbar">
              <span>Response schema</span>
              <button class="copy-button" type="button" data-copy="responseSample">Copy</button>
            </div>
            <pre id="responseSample">{
  "message": "The OTP Has Been Sent Successfully",
  "status": true
}</pre>
          </div>
        </article>
      </section>

      <section class="try-card">
        <div class="hero-top">
          <div>
            <h1>Try it</h1>
            <p class="note">Execute a real request against the backend and preview the JSON response instantly.</p>
          </div>
          <div id="liveStatus" class="status-pill">Ready</div>
        </div>

        <div id="formFields" class="try-grid"></div>

        <div class="submit-row">
          <p class="note">All requests use vanilla <code>fetch()</code>. For authenticated endpoints, paste your bearer token in the field below.</p>
          <button id="sendRequest" class="send-button">Send Request</button>
        </div>

        <div class="section-card">
          <div class="card-title">Live response</div>
          <div class="code-box">
            <div class="code-toolbar">
              <span>Developer console</span>
              <button class="copy-button" type="button" data-copy="liveResponse">Copy</button>
            </div>
            <pre id="liveResponse">{
  "message": "Choose an endpoint and send a request to see live JSON output.",
  "status": null
}</pre>
          </div>
        </div>
      </section>
    </main>
  </div>

  <script>
    const endpoints = {
      verifyotp: {
        title: 'Send OTP',
        method: 'POST',
        url: 'https://iclickapi-main-vfl3rp.free.laravel.cloud/api/verifyotp',
        description: "Send OTP to user's email for authentication. Use this endpoint to start the login flow with a one-time password.",
        requestSample: {
          firstname: 'string',
          email: 'string'
        },
        responseSample: {
          message: 'The OTP Has Been Sent Successfully',
          status: true
        },
        fields: [
          { name: 'firstname', label: 'Firstname', type: 'text', placeholder: 'Jane' },
          { name: 'email', label: 'Email', type: 'email', placeholder: 'jane@example.com' }
        ]
      },
      signup: {
        title: 'Signup',
        method: 'POST',
        url: 'https://iclickapi-main-vfl3rp.free.laravel.cloud/api/signup',
        description: 'Complete user registration using OTP verification. Provide full user details and OTP code to finish signup.',
        requestSample: {
          firstname: 'string',
          lastname: 'string',
          email: 'string',
          password: 'string',
          otp: 'string'
        },
        responseSample: {
          message: 'User registered successfully',
          status: true
        },
        fields: [
          { name: 'firstname', label: 'Firstname', type: 'text', placeholder: 'Jane' },
          { name: 'lastname', label: 'Lastname', type: 'text', placeholder: 'Doe' },
          { name: 'email', label: 'Email', type: 'email', placeholder: 'jane@example.com' },
          { name: 'password', label: 'Password', type: 'password', placeholder: '••••••••' },
          { name: 'otp', label: 'OTP Code', type: 'text', placeholder: '123456' }
        ]
      },
      signin: {
        title: 'Sign In',
        method: 'POST',
        url: 'https://iclickapi-main-vfl3rp.free.laravel.cloud/api/signin',
        description: 'Authenticate a user using email and password. Returns a token on success or an error message on failure.',
        requestSample: {
          email: 'string',
          password: 'string'
        },
        responseSample: {
          message: 'Login successful',
          status: true,
          token: 'string'
        },
        fields: [
          { name: 'email', label: 'Email', type: 'email', placeholder: 'jane@example.com' },
          { name: 'password', label: 'Password', type: 'password', placeholder: '••••••••' }
        ]
      },
      getmyprofile: {
        title: 'Get My Profile',
        method: 'GET',
        url: 'https://iclickapi-main-vfl3rp.free.laravel.cloud/api/getmyprofile',
        description: 'Fetch authenticated user profile data using Bearer token authentication.',
        requestSample: null,
        responseSample: {
          id: 1,
          firstname: 'string',
          lastname: 'string',
          email: 'string',
          created_at: 'date'
        },
        fields: [
          { name: 'token', label: 'Bearer Token', type: 'text', placeholder: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...' }
        ]
      },
      getposts: {
        title: 'Get Posts',
        method: 'GET',
        url: 'https://iclickapi-main-vfl3rp.free.laravel.cloud/api/getposts',
        description: 'Fetch the latest posts for the authenticated user. Requires Bearer token authentication.',
        requestSample: null,
        responseSample: [
          {
            id: 1,
            user_id: 1,
            image_url: 'string',
            created_at: 'date'
          }
        ],
        fields: [
          { name: 'token', label: 'Bearer Token', type: 'text', placeholder: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...' }
        ]
      },
      uploadpost: {
        title: 'Upload Post',
        method: 'POST',
        url: 'https://iclickapi-main-vfl3rp.free.laravel.cloud/api/uploadpost',
        description: 'Upload a post image using multipart/form-data with Bearer token authentication.',
        requestSample: {
          token: 'string',
          file: 'image'
        },
        responseSample: {
          message: 'Post uploaded successfully',
          status: true,
          post_url: 'string'
        },
        fields: [
          { name: 'token', label: 'Bearer Token', type: 'text', placeholder: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...' },
          { name: 'file', label: 'Upload Image', type: 'file', placeholder: '' }
        ]
      }
    };

    const endpointLinks = document.querySelectorAll('.endpoint-link');
    const endpointPath = document.getElementById('endpointPath');
    const endpointDescription = document.getElementById('endpointDescription');
    const requestSample = document.getElementById('requestSample');
    const responseSample = document.getElementById('responseSample');
    const formFields = document.getElementById('formFields');
    const liveResponse = document.getElementById('liveResponse');
    const liveStatus = document.getElementById('liveStatus');
    const sendButton = document.getElementById('sendRequest');
    const copyButtons = document.querySelectorAll('[data-copy]');
    const methodBadge = document.getElementById('methodBadge');

    let activeEndpoint = 'verifyotp';

    const formatJson = value => JSON.stringify(value, null, 2);

    const setStatus = (label, state = 'neutral') => {
      liveStatus.textContent = label;
      liveStatus.classList.remove('success', 'error');
      if (state === 'success') liveStatus.classList.add('success');
      if (state === 'error') liveStatus.classList.add('error');
    };

    const getMethodClass = method => method === 'GET' ? 'method-get' : 'method-post';

    const renderEndpoint = key => {
      activeEndpoint = key;
      const endpoint = endpoints[key];
      endpointPath.textContent = endpoint.url;
      endpointDescription.textContent = endpoint.description;
      requestSample.textContent = endpoint.requestSample ? formatJson(endpoint.requestSample) : 'No request body required for this endpoint.';
      responseSample.textContent = formatJson(endpoint.responseSample);
      methodBadge.textContent = endpoint.method;
      methodBadge.className = `endpoint-method ${getMethodClass(endpoint.method)}`;
      liveResponse.textContent = formatJson({ message: 'Choose an endpoint and send a request to see live JSON output.', status: null });
      setStatus('Ready');

      endpointLinks.forEach(link => {
        link.classList.toggle('active', link.dataset.endpoint === key);
      });

      formFields.innerHTML = endpoint.fields.map(field => {
        if (field.type === 'file') {
          return `
            <div class="form-field" style="grid-column: 1 / -1;">
              <label for="${key}-${field.name}">${field.label}</label>
              <input id="${key}-${field.name}" name="${field.name}" type="file" accept="image/*">
              <div id="preview-${field.name}" class="file-preview">
                <span>No file selected. Choose an image to preview.</span>
              </div>
            </div>
          `;
        }

        return `
          <div class="form-field">
            <label for="${key}-${field.name}">${field.label}</label>
            <input id="${key}-${field.name}" name="${field.name}" type="${field.type}" placeholder="${field.placeholder}" autocomplete="off">
          </div>
        `;
      }).join('');

      attachFilePreview();
    };

    const attachFilePreview = () => {
      const fileInput = document.querySelector('input[type="file"]');
      if (!fileInput) return;

      const preview = document.getElementById('preview-file');
      fileInput.addEventListener('change', event => {
        const file = event.target.files[0];
        if (!file) {
          preview.innerHTML = '<span>No file selected. Choose an image to preview.</span>';
          return;
        }
        const url = URL.createObjectURL(file);
        preview.innerHTML = `
          <span>Preview</span>
          <img src="${url}" alt="Image preview">
        `;
      });
    };

    const getFormPayload = () => {
      const endpoint = endpoints[activeEndpoint];
      const values = {};
      endpoint.fields.forEach(field => {
        const input = document.getElementById(`${activeEndpoint}-${field.name}`);
        if (!input) return;
        if (field.type === 'file') {
          values[field.name] = input.files && input.files[0] ? input.files[0] : null;
          return;
        }
        values[field.name] = input.value.trim();
      });
      return values;
    };

    const validatePayload = payload => {
      const missing = endpoints[activeEndpoint].fields.filter(field => {
        if (field.type === 'file') return !payload[field.name];
        return !payload[field.name];
      });
      if (missing.length) {
        return `Missing required fields: ${missing.map(field => field.label).join(', ')}`;
      }
      return null;
    };

    const updateButtonState = loading => {
      sendButton.disabled = loading;
      sendButton.textContent = loading ? 'Sending...' : 'Send Request';
    };

    const buildFetchOptions = payload => {
      const endpoint = endpoints[activeEndpoint];
      const options = {
        method: endpoint.method,
        headers: {
          'Accept': 'application/json'
        }
      };

      if (endpoint.method === 'GET') {
        if (payload.token) options.headers.Authorization = `Bearer ${payload.token}`;
        return options;
      }

      if (activeEndpoint === 'uploadpost') {
        const formData = new FormData();
        if (payload.file) formData.append('file', payload.file);
        if (payload.token) options.headers.Authorization = `Bearer ${payload.token}`;
        options.body = formData;
        return options;
      }

      options.headers['Content-Type'] = 'application/json';
      options.body = formatJson(payload);
      return options;
    };

    copyButtons.forEach(button => {
      button.addEventListener('click', () => {
        const target = button.dataset.copy;
        let text = '';
        if (target === 'requestSample') text = requestSample.textContent;
        if (target === 'responseSample') text = responseSample.textContent;
        if (target === 'liveResponse') text = liveResponse.textContent;
        if (!text) return;
        navigator.clipboard.writeText(text).then(() => {
          const original = button.textContent;
          button.textContent = 'Copied';
          button.style.background = 'rgba(84, 214, 255, 0.3)';
          setTimeout(() => {
            button.textContent = original;
            button.style.background = '';
          }, 1200);
        }).catch(() => {
          const original = button.textContent;
          button.textContent = 'Copy failed';
          setTimeout(() => {
            button.textContent = original;
          }, 1200);
        });
      });
    });

    endpointLinks.forEach(link => {
      link.addEventListener('click', () => renderEndpoint(link.dataset.endpoint));
    });

    sendButton.addEventListener('click', async () => {
      const endpoint = endpoints[activeEndpoint];
      const payload = getFormPayload();
      const validationError = validatePayload(payload);

      if (validationError) {
        liveResponse.textContent = formatJson({ message: validationError, status: false });
        setStatus('Validation error', 'error');
        return;
      }

      updateButtonState(true);
      setStatus('Sending...');
      liveResponse.textContent = formatJson({ message: 'Awaiting API response...', status: null });

      try {
        const options = buildFetchOptions(payload);
        const response = await fetch(endpoint.url, options);
        const data = await response.json();
        liveResponse.textContent = formatJson(data);
        const success = data && (data.status === true || data.status === 'true');
        setStatus(success ? 'Success' : 'Error', success ? 'success' : 'error');
      } catch (error) {
        liveResponse.textContent = formatJson({ message: error.message || 'Unable to reach API', status: false });
        setStatus('Network error', 'error');
      } finally {
        updateButtonState(false);
      }
    });

    renderEndpoint(activeEndpoint);
  </script>
  <footer class="footer-container">
    <div class="footer-credit">Codeed by <strong>Abanob Nabeh</strong></div>
    <div class="footer-links">
      <a href="https://discord.com/users/979502686225461318" target="_blank" rel="noopener" class="social-link" aria-label="Discord">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.317 4.369a19.791 19.791 0 00-4.885-1.515.07.07 0 00-.074.037 13.66 13.66 0 00-.59 1.204 18.827 18.827 0 00-5.778 0 12.81 12.81 0 00-.603-1.204.069.069 0 00-.074-.037 19.736 19.736 0 00-4.886 1.515.062.062 0 00-.028.023C2.83 9.04 2.27 13.573 2.54 18.057a.082.082 0 00.031.056 19.9 19.9 0 006.041 3.07.07.07 0 00.077-.027 13.914 13.914 0 001.212-1.86.07.07 0 00-.034-.097 11.133 11.133 0 01-1.588-.762.07.07 0 01-.006-.118c.106-.08.212-.163.311-.248a.07.07 0 01.073-.01c3.327 1.519 6.927 1.519 10.218 0a.07.07 0 01.075.01c.099.085.205.168.311.248a.07.07 0 01-.006.118 11.174 11.174 0 01-1.588.762.07.07 0 00-.034.097 13.877 13.877 0 001.212 1.86.07.07 0 00.077.027 19.869 19.869 0 006.04-3.07.082.082 0 00.032-.056c.533-5.177-.838-9.67-2.673-13.665a.061.061 0 00-.028-.023zm-11.42 9.707c-1.183 0-2.156-1.085-2.156-2.419 0-1.333.955-2.418 2.156-2.418 1.21 0 2.18 1.098 2.155 2.418 0 1.334-.955 2.419-2.155 2.419zm6.174 0c-1.183 0-2.156-1.085-2.156-2.419 0-1.333.955-2.418 2.156-2.418 1.21 0 2.18 1.098 2.155 2.418 0 1.334-.945 2.419-2.155 2.419z"/></svg>
      </a>
      <a href="https://github.com/AbanobNabeh" target="_blank" rel="noopener" class="social-link" aria-label="GitHub">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.167 6.839 9.489.5.092.682-.217.682-.483 0-.237-.009-.868-.014-1.703-2.782.604-3.369-1.342-3.369-1.342-.454-1.153-1.11-1.461-1.11-1.461-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.529 2.341 1.088 2.91.833.091-.647.349-1.088.636-1.338-2.22-.253-4.555-1.112-4.555-4.944 0-1.091.39-1.984 1.032-2.682-.103-.253-.447-1.27.098-2.645 0 0 .84-.269 2.75 1.025A9.563 9.563 0 0112 6.845c.85.004 1.705.115 2.504.338 1.909-1.294 2.748-1.025 2.748-1.025.547 1.375.203 2.392.1 2.645.644.698 1.031 1.591 1.031 2.682 0 3.842-2.338 4.687-4.566 4.937.359.308.678.918.678 1.852 0 1.336-.012 2.415-.012 2.744 0 .268.18.579.688.48C19.137 20.165 22 16.418 22 12c0-5.523-4.477-10-10-10z"/></svg>
      </a>
      <a href="https://instagram.com/AbanobNabeeh" target="_blank" rel="noopener" class="social-link" aria-label="Instagram">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 1.5A4.25 4.25 0 003.5 7.75v8.5A4.25 4.25 0 007.75 20.5h8.5a4.25 4.25 0 004.25-4.25v-8.5A4.25 4.25 0 0016.25 3.5h-8.5zm8.75 2.25a.75.75 0 110 1.5.75.75 0 010-1.5zm-4.25 1.25a5.25 5.25 0 110 10.5 5.25 5.25 0 010-10.5zm0 1.5a3.75 3.75 0 100 7.5 3.75 3.75 0 000-7.5z"/></svg>
      </a>
      <a href="https://ko-fi.com/abanobnabeh" target="_blank" rel="noopener" class="social-link" aria-label="Ko-fi">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2.5C7.03 2.5 3 6.53 3 11.5c0 5.5 5.91 9.45 8.4 10.86a1.15 1.15 0 001.2 0C15.09 20.95 21 17 21 11.5 21 6.53 16.97 2.5 12 2.5zm0 15.5c-2.82-.18-6.4-2.58-6.4-6.5 0-3.5 2.85-6.3 6.4-6.5 3.55.2 6.4 3 6.4 6.5 0 3.92-3.58 6.32-6.4 6.5z"/><path d="M10.5 8.75h1.1c.42 0 .76.34.76.76v5.02a.75.75 0 01-1.5 0V9.49h-.36a.74.74 0 01-.75-.74c0-.41.34-.74.75-.74zm3.76 2.04a.75.75 0 011.5 0v3.1a.75.75 0 01-1.5 0v-3.1z"/></svg>
      </a>
      <a href="https://www.linkedin.com/in/abanob-nabeh-181493224" target="_blank" rel="noopener" class="social-link" aria-label="LinkedIn">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.94 6.5a2.06 2.06 0 11-.001 4.122A2.06 2.06 0 016.94 6.5zm.06 4.98H4.5V20h2.5V11.48zm4.88 0h-2.5V20h2.5v-4.9c0-1.18.1-2.7 1.64-2.7 1.55 0 1.56 1.32 1.56 2.78V20h2.5v-5.2c0-3.7-.78-5.3-4.1-5.3-1.86 0-2.63 1.03-3.08 1.75h.04V11.5z"/></svg>
      </a>
      <a href="https://www.facebook.com/abanobnabeeh" target="_blank" rel="noopener" class="social-link" aria-label="Facebook">
        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.43 8.86 8 9.8V15H8v-3h2v-2.2C10 8.8 11 8 12.76 8c.85 0 1.53.06 1.74.09v2.02h-1.2c-.94 0-1.12.45-1.12 1.1V12h2.3l-.3 3H13.3v6.8c4.57-.94 8-4.96 8-9.8z"/></svg>
      </a>
    </div>
  </footer>
</body>
</html>
