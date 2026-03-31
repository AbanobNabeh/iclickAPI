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
</body>
</html>
