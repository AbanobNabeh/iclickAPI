<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iClick API Docs</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (v3.4 CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    colors: {
                        dark: { 950: '#030509', 900: '#0A0E17', 800: '#111827', 700: '#1F2937', 600: '#374151' },
                        brand: { 500: '#3B82F6', 600: '#2563EB', 400: '#60A5FA' },
                    }
                }
            }
        }
    </script>

    <!-- React & ReactDOM (v18.2 CDN) -->
    <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
    <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>

    <style>
        body { 
            background: #030509; 
            background-image: 
                radial-gradient(circle at top right, rgba(14, 27, 61, 1), transparent 30%),
                radial-gradient(circle at bottom left, rgba(23, 14, 46, 0.8), transparent 35%);
            background-attachment: fixed;
            color: #F8FAFC; 
            margin: 0; 
            min-height: 100vh;
        }
        
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #1F2937; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #374151; }
        
        .glass-panel { 
            background: rgba(10, 14, 23, 0.7); 
            backdrop-filter: blur(20px); 
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.06); 
        }
        .glass-card { 
            background: rgba(17, 24, 39, 0.6); 
            backdrop-filter: blur(12px); 
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08); 
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); 
        }
        
        .method-badge-get { color: #60A5FA; background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); }
        .method-badge-post { color: #34D399; background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); }
        .method-badge-put { color: #FBBF24; background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.2); }
        .method-badge-delete { color: #F87171; background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); }

        /* JSON Syntax Highlighting */
        .json-key { color: #9CDCFE; }
        .json-string { color: #CE9178; }
        .json-number { color: #B5CEA8; }
        .json-boolean { color: #569CD6; }
        .json-null { color: #569CD6; }

        .form-input {
            width: 100%;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            padding: 0.6rem 1rem;
            border-radius: 0.75rem;
            transition: all 0.2s;
            outline: none;
        }
        .form-input:focus {
            border-color: #3B82F6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }
    </style>
</head>
<body class="antialiased font-sans flex flex-col min-h-screen">
    
<header class="sticky top-0 z-50 w-full glass-panel border-b border-white/5 px-4 md:px-8 py-3 flex flex-col md:flex-row items-center justify-between gap-4 shadow-2xl backdrop-blur-xl bg-[#030509]/80 transition-all shrink-0">
    <!-- Left Side: Custom Brand Credit -->
    <div class="flex items-center gap-3">
        <div class="text-slate-400 text-xs md:text-[13px] font-medium whitespace-nowrap">
            Coded by <a href="https://abanobnabeh.github.io/portfolio/" target="_blank" rel="noopener" class="text-white hover:text-brand-400 transition-colors font-bold pb-0.5 border-b border-brand-500/30 hover:border-brand-400">Abanob Nabeh</a>
        </div>
    </div>



    <!-- Right Side: Links & Socials -->
    <div class="flex flex-wrap items-center justify-center gap-3 md:gap-4 no-scrollbar">
        <!-- Buttons -->
        <div class="flex items-center gap-2">
            <a href="https://github.com/AbanobNabeh/iclickAPI.git" target="_blank" rel="noopener" class="flex items-center gap-1.5 px-3 md:px-4 py-1.5 md:py-2 rounded-full bg-white/5 hover:bg-white/10 border border-white/10 text-white text-[10px] md:text-xs font-semibold transition-all hover:scale-105 shadow-sm whitespace-nowrap group">
                <svg class="w-3.5 h-3.5 md:w-4 md:h-4 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .33.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z" />
                </svg>
                Source
            </a>
            <a href="https://github.com/AbanobNabeh/iClick" target="_blank" rel="noopener" class="flex items-center gap-1.5 px-3 md:px-4 py-1.5 md:py-2 rounded-full bg-brand-500/10 hover:bg-brand-500/20 border border-brand-500/30 text-brand-400 hover:text-brand-300 text-[10px] md:text-xs font-semibold transition-all hover:scale-105 shadow-[0_0_15px_rgba(59,130,246,0.15)] hover:shadow-[0_0_25px_rgba(59,130,246,0.25)] whitespace-nowrap group">
                <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="currentColor" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.083 0l-16.015 16 4.932 4.932 20.912-20.916h-9.808zM19.104 14.76l-8.631 8.609 8.631 8.631h9.828l-8.615-8.625 8.615-8.615z"></path>
                </svg>
                App Flutter
            </a>
        </div>

        <div class="hidden md:block w-px h-6 bg-white/10"></div>

        <!-- Social Icons -->
        <div class="flex items-center gap-2 lg:gap-2.5">
            <a href="https://discord.com/users/979502686225461318" target="_blank" rel="noopener" aria-label="Discord"
                class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-white/5 hover:bg-brand-500/20 border border-transparent hover:border-brand-500/30 flex items-center justify-center text-slate-400 hover:text-white transition-all hover:scale-110 shadow-sm shrink-0 group">
                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M20.317 4.369a19.791 19.791 0 00-4.885-1.515.07.07 0 00-.074.037 13.66 13.66 0 00-.59 1.204 18.827 18.827 0 00-5.778 0 12.81 12.81 0 00-.603-1.204.069.069 0 00-.074-.037 19.736 19.736 0 00-4.886 1.515.062.062 0 00-.028.023C2.83 9.04 2.27 13.573 2.54 18.057a.082.082 0 00.031.056 19.9 19.9 0 006.041 3.07.07.07 0 00.077-.027 13.914 13.914 0 001.212-1.86.07.07 0 00-.034-.097 11.133 11.133 0 01-1.588-.762.07.07 0 01-.006-.118c.106-.08.212-.163.311-.248a.07.07 0 01.073-.01c3.327 1.519 6.927 1.519 10.218 0a.07.07 0 01.075.01c.099.085.205.168.311.248a.07.07 0 01-.006.118 11.174 11.174 0 01-1.588.762.07.07 0 00-.034.097 13.877 13.877 0 001.212 1.86.07.07 0 00.077.027 19.869 19.869 0 006.04-3.07.082.082 0 00.032-.056c.533-5.177-.838-9.67-2.673-13.665a.061.061 0 00-.028-.023zm-11.42 9.707c-1.183 0-2.156-1.085-2.156-2.419 0-1.333.955-2.418 2.156-2.418 1.21 0 2.18 1.098 2.155 2.418 0 1.334-.955 2.419-2.155 2.419zm6.174 0c-1.183 0-2.156-1.085-2.156-2.419 0-1.333.955-2.418 2.156-2.418 1.21 0 2.18 1.098 2.155 2.418 0 1.334-.945 2.419-2.155 2.419z" />
                </svg>
            </a>
            <a href="https://github.com/AbanobNabeh" target="_blank" rel="noopener" aria-label="GitHub"
                class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-white/5 hover:bg-brand-500/20 border border-transparent hover:border-brand-500/30 flex items-center justify-center text-slate-400 hover:text-white transition-all hover:scale-110 shadow-sm shrink-0 group">
                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.167 6.839 9.489.5.092.682-.217.682-.483 0-.237-.009-.868-.014-1.703-2.782.604-3.369-1.342-3.369-1.342-.454-1.153-1.11-1.461-1.11-1.461-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.529 2.341 1.088 2.91.833.091-.647.349-1.088.636-1.338-2.22-.253-4.555-1.112-4.555-4.944 0-1.091.39-1.984 1.032-2.682-.103-.253-.447-1.27.098-2.645 0 0 .84-.269 2.75 1.025A9.563 9.563 0 0112 6.845c.85.004 1.705.115 2.504.338 1.909-1.294 2.748-1.025 2.748-1.025.547 1.375.203 2.392.1 2.645.644.698 1.031 1.591 1.031 2.682 0 3.842-2.338 4.687-4.566 4.937.359.308.678.918.678 1.852 0 1.336-.012 2.415-.012 2.744 0 .268.18.579.688.48C19.137 20.165 22 16.418 22 12c0-5.523-4.477-10-10-10z" />
                </svg>
            </a>
            <a href="https://instagram.com/AbanobNabeeh" target="_blank" rel="noopener" aria-label="Instagram"
                class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-white/5 hover:bg-brand-500/20 border border-transparent hover:border-brand-500/30 flex items-center justify-center text-slate-400 hover:text-white transition-all hover:scale-110 shadow-sm shrink-0 group">
                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 1.5A4.25 4.25 0 003.5 7.75v8.5A4.25 4.25 0 007.75 20.5h8.5a4.25 4.25 0 004.25-4.25v-8.5A4.25 4.25 0 0016.25 3.5h-8.5zm8.75 2.25a.75.75 0 110 1.5.75.75 0 010-1.5zm-4.25 1.25a5.25 5.25 0 110 10.5 5.25 5.25 0 010-10.5zm0 1.5a3.75 3.75 0 100 7.5 3.75 3.75 0 000-7.5z" />
                </svg>
            </a>
            <a href="https://ko-fi.com/abanobnabeh" target="_blank" rel="noopener" aria-label="Ko-fi"
                class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-white/5 hover:bg-brand-500/20 border border-transparent hover:border-brand-500/30 flex items-center justify-center text-slate-400 hover:text-white transition-all hover:scale-110 shadow-sm shrink-0 group">
                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 2.5C7.03 2.5 3 6.53 3 11.5c0 5.5 5.91 9.45 8.4 10.86a1.15 1.15 0 001.2 0C15.09 20.95 21 17 21 11.5 21 6.53 16.97 2.5 12 2.5zm0 15.5c-2.82-.18-6.4-2.58-6.4-6.5 0-3.5 2.85-6.3 6.4-6.5 3.55.2 6.4 3 6.4 6.5 0 3.92-3.58 6.32-6.4 6.5z" />
                    <path d="M10.5 8.75h1.1c.42 0 .76.34.76.76v5.02a.75.75 0 01-1.5 0V9.49h-.36a.74.74 0 01-.75-.74c0-.41.34-.74.75-.74zm3.76 2.04a.75.75 0 011.5 0v3.1a.75.75 0 01-1.5 0v-3.1z" />
                </svg>
            </a>
            <a href="https://www.linkedin.com/in/abanob-nabeh-181493224" target="_blank" rel="noopener" aria-label="LinkedIn"
                class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-white/5 hover:bg-brand-500/20 border border-transparent hover:border-brand-500/30 flex items-center justify-center text-slate-400 hover:text-white transition-all hover:scale-110 shadow-sm shrink-0 group">
                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M6.94 6.5a2.06 2.06 0 11-.001 4.122A2.06 2.06 0 016.94 6.5zm.06 4.98H4.5V20h2.5V11.48zm4.88 0h-2.5V20h2.5v-4.9c0-1.18.1-2.7 1.64-2.7 1.55 0 1.56 1.32 1.56 2.78V20h2.5v-5.2c0-3.7-.78-5.3-4.1-5.3-1.86 0-2.63 1.03-3.08 1.75h.04V11.5z" />
                </svg>
            </a>
            <a href="https://www.facebook.com/abanobnabeeh" target="_blank" rel="noopener" aria-label="Facebook"
                class="w-8 h-8 md:w-9 md:h-9 rounded-full bg-white/5 hover:bg-brand-500/20 border border-transparent hover:border-brand-500/30 flex items-center justify-center text-slate-400 hover:text-white transition-all hover:scale-110 shadow-sm shrink-0 group">
                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.43 8.86 8 9.8V15H8v-3h2v-2.2C10 8.8 11 8 12.76 8c.85 0 1.53.06 1.74.09v2.02h-1.2c-.94 0-1.12.45-1.12 1.1V12h2.3l-.3 3H13.3v6.8c4.57-.94 8-4.96 8-9.8z" />
                </svg>
            </a>
        </div>
    </div>
</header>
    <div id="root" class="flex-grow flex flex-col"></div>

    <script>
        window.INITIAL_DATA = {
            visitorCount: {{ $count ?? 0 }},
            baseUrl: "https://iclickapi-main-vfl3rp.free.laravel.cloud"
        };
    </script>
    
    <script type="text/babel">
        const { useState, useEffect, useRef, useMemo } = React;

        // --- Icons ---
        const IconSearch = () => <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>;
        const IconCopy = () => <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>;
        const IconCheck = () => <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10B981" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>;
        const IconPlay = () => <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>;
        const IconExternal = () => <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>;
        const IconGithub = () => <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.477 2 2 6.477 2 12c0 4.418 2.865 8.167 6.839 9.489.5.092.682-.217.682-.483 0-.237-.009-.868-.014-1.703-2.782.604-3.369-1.342-3.369-1.342-.454-1.153-1.11-1.461-1.11-1.461-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.529 2.341 1.088 2.91.833.091-.647.349-1.088.636-1.338-2.22-.253-4.555-1.112-4.555-4.944 0-1.091.39-1.984 1.032-2.682-.103-.253-.447-1.27.098-2.645 0 0 .84-.269 2.75 1.025A9.563 9.563 0 0112 6.845c.85.004 1.705.115 2.504.338 1.909-1.294 2.748-1.025 2.748-1.025.547 1.375.203 2.392.1 2.645.644.698 1.031 1.591 1.031 2.682 0 3.842-2.338 4.687-4.566 4.937.359.308.678.918.678 1.852 0 1.336-.012 2.415-.012 2.744 0 .268.18.579.688.48C19.137 20.165 22 16.418 22 12c0-5.523-4.477-10-10-10z" /></svg>;

        // --- Data ---
        const apiBaseUrl = window.INITIAL_DATA.baseUrl;
        
        const endpointsData = [
            {
                id: 'verifyotp', name: 'Verify OTP', method: 'POST', path: '/api/verifyotp',
                description: "Verifies the OTP sent to the user's email during the onboarding or password reset flow.",
                auth: false, multipart: false,
                fields: [
                    { name: 'firstname', type: 'text', placeholder: 'John' },
                    { name: 'email', type: 'email', placeholder: 'user@example.com' }
                ],
                reqSchema: { firstname: "string", email: "string" },
                resSchema: { message: "The OTP Has Been Sent Successfully", status: true }
            },
            {
                id: 'signup', name: 'Signup', method: 'POST', path: '/api/signup',
                description: "Registers a new user and generates an initial session token.",
                auth: false, multipart: false,
                fields: [
                    { name: 'firstname', type: 'text', placeholder: 'John' },
                    { name: 'lastname', type: 'text', placeholder: 'Doe' },
                    { name: 'email', type: 'email', placeholder: 'user@example.com' },
                    { name: 'password', type: 'password', placeholder: 'StrongPassword123!' },
                    { name: 'otp', type: 'text', placeholder: '123456' }
                ],
                reqSchema: { firstname: "string", lastname: "string", email: "string", password: "string", otp: "string" },
                resSchema: { message: "User registered successfully", status: true, token: "jwt_token_here" }
            },
            {
                id: 'signin', name: 'Sign In', method: 'POST', path: '/api/signin',
                description: "Authenticates an existing user and returns a Bearer token.",
                auth: false, multipart: false,
                fields: [
                    { name: 'email', type: 'email', placeholder: 'user@example.com' },
                    { name: 'password', type: 'password', placeholder: 'StrongPassword123!' }
                ],
                reqSchema: { email: "string", password: "string" },
                resSchema: { message: "Login successful", status: true, token: "jwt_token_here" }
            },
            {
                id: 'getmyprofile', name: 'Get Profile', method: 'GET', path: '/api/getmyprofile',
                description: "Retrieves the profile data of the currently authenticated user.",
                auth: true, multipart: false,
                fields: [], reqSchema: null,
                resSchema: { id: 1, firstname: "John", lastname: "Doe", email: "user@example.com", created_at: "2024-01-01T00:00:00Z" }
            },
            {
                id: 'getposts', name: 'Get Posts', method: 'GET', path: '/api/getposts',
                description: "Fetches a paginated list of posts.",
                auth: true, multipart: false,
                fields: [], reqSchema: null,
                resSchema: [{ id: 101, user_id: 1, image_url: "https://...", created_at: "2024-01-01T00:00:00Z" }]
            },
            {
                id: 'getreels', name: 'Get Reels', method: 'GET', path: '/api/getreels',
                description: "Fetches the latest short video reels.",
                auth: true, multipart: false,
                fields: [], reqSchema: null,
                resSchema: [{ id: 202, user_id: 1, video_url: "https://...", caption: "Awesome reel!", created_at: "2024-01-01T00:00:00Z" }]
            },
            {
                id: 'follow', name: 'Follow User', method: 'POST', path: '/api/follow',
                description: "Follows a specific user by ID.",
                auth: true, multipart: false,
                fields: [{ name: 'iduser', type: 'text', placeholder: '2' }],
                reqSchema: { iduser: 2 },
                resSchema: { message: "Followed successfully", status: true }
            },
            {
                id: 'unfollow', name: 'Unfollow User', method: 'POST', path: '/api/unfollow',
                description: "Unfollows a specific user by ID.",
                auth: true, multipart: false,
                fields: [{ name: 'iduser', type: 'text', placeholder: '2' }],
                reqSchema: { iduser: 2 },
                resSchema: { message: "Unfollowed successfully", status: true }
            },
            {
                id: 'uploadpost', name: 'Upload Post', method: 'POST', path: '/api/uploadpost',
                description: "Uploads an image post payload. Requires multipart/form-data.",
                auth: true, multipart: true,
                fields: [{ name: 'file', type: 'file', accept: 'image/*' }],
                reqSchema: { file: "binary (image/*)" },
                resSchema: { message: "Post uploaded successfully", status: true, post_url: "https://..." }
            },
            {
                id: 'uploadreel', name: 'Upload Reel', method: 'POST', path: '/api/uploadreel',
                description: "Uploads a short video reel with an optional caption.",
                auth: true, multipart: true,
                fields: [
                    { name: 'file', type: 'file', accept: 'video/mp4,video/x-m4v,video/*' },
                    { name: 'caption', type: 'text', placeholder: 'Summer vibes...' }
                ],
                reqSchema: { file: "binary (video/*)", caption: "string" },
                resSchema: { message: "Reel uploaded successfully", status: true, reel_url: "https://..." }
            },
            {
                id: 'uploadstory', name: 'Upload Story', method: 'POST', path: '/api/uploadstory',
                description: "Uploads an ephemeral story image.",
                auth: true, multipart: true,
                fields: [{ name: 'file', type: 'file', accept: 'image/*' }],
                reqSchema: { file: "binary (image/*)" },
                resSchema: { message: "Story uploaded successfully", status: true, story_url: "https://..." }
            },
            {
                id: 'getstories', name: 'Get Stories', method: 'GET', path: '/api/getstories',
                description: "Retrieves active stories for the authenticated user and their following.",
                auth: true, multipart: false,
                fields: [], reqSchema: null,
                resSchema: [{ id: 301, user_id: 1, image_url: "https://...", created_at: "2024-01-01T00:00:00Z" }]
            }
        ];

        // --- Utils Syntax highlighting ---
        const syntaxHighlight = (json) => {
            if (!json) return '';
            if (typeof json != 'string') {
                 json = JSON.stringify(json, undefined, 2);
            }
            json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
            return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
                let cls = 'json-number';
                if (/^"/.test(match)) {
                    if (/:$/.test(match)) {
                        cls = 'json-key';
                    } else {
                        cls = 'json-string';
                    }
                } else if (/true|false/.test(match)) {
                    cls = 'json-boolean';
                } else if (/null/.test(match)) {
                    cls = 'json-null';
                }
                return '<span class="' + cls + '">' + match + '</span>';
            });
        };

        const getMarkup = (obj) => {
            return { __html: syntaxHighlight(obj) };
        };

        // --- Subcomponents ---

        const Toast = ({ message, type, onClose }) => {
            useEffect(() => {
                const timer = setTimeout(onClose, 3000);
                return () => clearTimeout(timer);
            }, [onClose]);

            const bgColors = {
                success: 'bg-emerald-500/10 border-emerald-500/20 text-emerald-400',
                error: 'bg-red-500/10 border-red-500/20 text-red-400',
                info: 'bg-brand-500/10 border-brand-500/20 text-brand-400'
            };

            return (
                <div className={`fixed bottom-6 right-6 px-4 py-3 rounded-xl border backdrop-blur-md shadow-2xl flex items-center gap-3 animate-[slideIn_0.3s_ease-out] z-50 ${bgColors[type]}`}>
                    {type === 'success' ? <IconCheck /> : null}
                    <span className="text-sm font-medium">{message}</span>
                </div>
            );
        };

        const CopyButton = ({ textToCopy, onCopy }) => {
            const [copied, setCopied] = useState(false);

            const handleCopy = () => {
                navigator.clipboard.writeText(textToCopy);
                setCopied(true);
                onCopy && onCopy();
                setTimeout(() => setCopied(false), 2000);
            };

            return (
                <button 
                    onClick={handleCopy}
                    className="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/5 hover:bg-white/10 text-xs font-medium text-slate-300 transition-colors border border-white/5"
                >
                    {copied ? <IconCheck /> : <IconCopy />}
                    {copied ? 'Copied' : 'Copy'}
                </button>
            );
        };

        const MethodBadge = ({ method }) => {
            const className = `px-2 py-0.5 rounded text-[10px] font-bold tracking-wider method-badge-${method.toLowerCase()}`;
            return <span className={className}>{method}</span>;
        };

        // --- Main Application ---
        const App = () => {
            const [activeId, setActiveId] = useState(endpointsData[0].id);
            const [searchQuery, setSearchQuery] = useState("");
            const [filterMethod, setFilterMethod] = useState("ALL");
            const [toast, setToast] = useState(null);
            
            // "Try it" State
            const [formData, setFormData] = useState({});
            const [globalToken, setGlobalToken] = useState("");
            const [loading, setLoading] = useState(false);
            const [response, setResponse] = useState(null);
            const [responseStatus, setResponseStatus] = useState(null);

            const activeEndpoint = useMemo(() => endpointsData.find(e => e.id === activeId), [activeId]);

            const filteredEndpoints = useMemo(() => {
                return endpointsData.filter(e => {
                    const matchQuery = e.name.toLowerCase().includes(searchQuery.toLowerCase()) || e.path.toLowerCase().includes(searchQuery.toLowerCase());
                    const matchMethod = filterMethod === "ALL" || e.method === filterMethod;
                    return matchQuery && matchMethod;
                });
            }, [searchQuery, filterMethod]);

            const showToast = (message, type = 'info') => setToast({ message, type });

            const handleFormChange = (e, fieldName, type) => {
                if (type === 'file') {
                    setFormData(prev => ({ ...prev, [fieldName]: e.target.files[0] }));
                } else {
                    setFormData(prev => ({ ...prev, [fieldName]: e.target.value }));
                }
            };

            const executeRequest = async () => {
                setLoading(true);
                setResponse(null);
                setResponseStatus(null);
                
                try {
                    const url = `${apiBaseUrl}${activeEndpoint.path}`;
                    let options = {
                        method: activeEndpoint.method,
                        headers: {
                            'Accept': 'application/json'
                        }
                    };

                    if (activeEndpoint.auth && globalToken) {
                        options.headers['Authorization'] = `Bearer ${globalToken}`;
                    } else if (activeEndpoint.auth && !globalToken) {
                        throw new Error('Bearer Token is required for this endpoint');
                    }

                    if (activeEndpoint.method !== 'GET') {
                        if (activeEndpoint.multipart) {
                            const fd = new FormData();
                            activeEndpoint.fields.forEach(f => {
                                if (formData[f.name]) {
                                    fd.append(f.name, formData[f.name]);
                                }
                            });
                            options.body = fd;
                            // Let fetch set Content-Type for multipart
                        } else {
                            options.headers['Content-Type'] = 'application/json';
                            options.body = JSON.stringify(formData);
                        }
                    }

                    const res = await fetch(url, options);
                    const data = await res.json().catch(() => null) || { error: 'Invalid JSON response from server' };
                    
                    setResponseStatus(res.status);
                    setResponse(data);

                    if (res.ok) {
                        showToast(`Request successful (${res.status})`, 'success');
                    } else {
                        showToast(`Request failed (${res.status})`, 'error');
                    }

                } catch (err) {
                    setResponse({ error: err.message });
                    setResponseStatus('ERROR');
                    showToast(err.message, 'error');
                } finally {
                    setLoading(false);
                }
            };

            // Switch endpoint
            const handleSelectEndpoint = (k) => {
                setActiveId(k);
                setResponse(null);
                setResponseStatus(null);
                setFormData({});
            }

            return (
                <div className="flex h-screen overflow-hidden">
                    {/* Header for Mobile - Hidden on Desktop */}
                    <div className="md:hidden glass-panel border-b fixed top-0 w-full z-40 p-4 shrink-0 flex items-center justify-between">
                        <h1 className="font-bold text-lg">iClick API</h1>
                        <a href="https://github.com/AbanobNabeh/iclickAPI.git" target="_blank" className="text-slate-400 hover:text-white transition-colors">
                            <IconGithub />
                        </a>
                    </div>

                    {/* Left Sidebar */}
                    <aside className="hidden md:flex flex-col w-[320px] shrink-0 glass-panel border-r z-30 overflow-y-auto">
                        <div className="p-6">
                            <h2 className="text-xl font-extrabold mb-1 tracking-tight text-white flex items-center gap-2">
                                <div className="w-6 h-6 rounded-lg bg-gradient-to-br from-brand-400 to-brand-600 flex items-center justify-center text-xs text-white">iC</div>
                                iClick API Docs
                            </h2>
                            <p className="text-sm text-slate-400 mb-6">Explore the powerful backend powering iClick. Dynamic testing enabled.</p>
                            
                            {/* Search & Filter */}
                            <div className="space-y-3 mb-6">
                                <div className="relative">
                                    <div className="absolute inset-y-0 left-3 flex items-center pointer-events-none text-slate-500">
                                        <IconSearch />
                                    </div>
                                    <input 
                                        type="text" 
                                        placeholder="Search endpoints..." 
                                        className="form-input pl-10 text-sm py-2 bg-dark-900/50"
                                        value={searchQuery}
                                        onChange={(e) => setSearchQuery(e.target.value)}
                                    />
                                </div>
                                <div className="flex bg-dark-900/50 p-1 rounded-lg">
                                    {['ALL', 'GET', 'POST'].map(m => (
                                        <button 
                                            key={m}
                                            onClick={() => setFilterMethod(m)}
                                            className={`flex-1 text-xs py-1.5 rounded-md font-medium transition-colors ${filterMethod === m ? 'bg-dark-700 text-white shadow-sm' : 'text-slate-400 hover:text-white'}`}
                                        >
                                            {m}
                                        </button>
                                    ))}
                                </div>
                            </div>
                        </div>

                        <div className="flex-1 px-4 pb-6 space-y-1">
                            {filteredEndpoints.map(ep => (
                                <button 
                                    key={ep.id}
                                    onClick={() => handleSelectEndpoint(ep.id)}
                                    className={`w-full text-left px-4 py-3 rounded-xl flex flex-col gap-1.5 transition-all fast-transition group ${
                                        activeId === ep.id 
                                            ? 'bg-brand-500/10 border border-brand-500/30 shadow-[inset_0_1px_0_rgba(255,255,255,0.05)]' 
                                            : 'border border-transparent hover:bg-dark-800/60'
                                    }`}
                                >
                                    <div className="flex items-center justify-between">
                                        <span className={`text-sm font-semibold ${activeId === ep.id ? 'text-brand-400' : 'text-slate-300 group-hover:text-white'}`}>
                                            {ep.name}
                                        </span>
                                        <MethodBadge method={ep.method} />
                                    </div>
                                    <span className="text-[11px] font-mono text-slate-500 truncate">{ep.path}</span>
                                </button>
                            ))}
                            {filteredEndpoints.length === 0 && (
                                <div className="text-center py-10 text-slate-500 text-sm">No endpoints matched your search.</div>
                            )}
                        </div>

                        <div className="p-4 border-t border-white/5 mt-auto">
                            <a href="https://github.com/AbanobNabeh/iclickAPI.git" target="_blank" className="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-sm font-medium transition-colors">
                                <IconGithub /> View Source Code
                            </a>
                        </div>
                    </aside>

                    {/* Main Content Area */}
                    <main className="flex-1 bg-dark-950 overflow-y-auto flex flex-col pt-16 md:pt-0">
                        {/* Header */}
                        <header className="px-8 py-8 md:py-10 border-b border-white/5 glass-panel sticky top-0 md:static z-20">
                            <div className="max-w-6xl mx-auto flex flex-col md:flex-row md:items-end justify-between gap-6">
                                <div>
                                    <div className="flex items-center gap-3 mb-3">
                                        <MethodBadge method={activeEndpoint.method} />
                                        <h1 className="text-3xl font-extrabold tracking-tight">{activeEndpoint.name}</h1>
                                        {activeEndpoint.auth && (
                                            <span className="px-2 py-0.5 rounded text-[10px] font-bold tracking-wider bg-orange-500/10 text-orange-400 border border-orange-500/20">AUTH</span>
                                        )}
                                    </div>
                                    <div className="flex items-center gap-2 flex-wrap">
                                        <span className="font-mono text-sm bg-dark-900 border border-white/10 px-3 py-1 rounded-lg text-slate-300 flex items-center gap-2">
                                            {apiBaseUrl}
                                            <span className="text-white font-semibold">{activeEndpoint.path}</span>
                                        </span>
                                        <button 
                                            onClick={() => {
                                                navigator.clipboard.writeText(`${apiBaseUrl}${activeEndpoint.path}`);
                                                showToast('URL Copied', 'success');
                                            }}
                                            className="p-1.5 rounded-lg bg-white/5 hover:bg-white/10 text-slate-400 transition-colors"
                                            title="Copy full URL"
                                        >
                                            <IconCopy />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </header>

                        {/* Content Body */}
                        <div className="flex-1 p-8">
                            <div className="max-w-6xl mx-auto grid grid-cols-1 xl:grid-cols-12 gap-10">
                                
                                {/* Left Column: Docs & Schemas */}
                                <div className="xl:col-span-7 space-y-8">
                                    <section>
                                        <p className="text-slate-300 leading-relaxed text-[15px]">{activeEndpoint.description}</p>
                                    </section>

                                    <div className="space-y-6">
                                        {activeEndpoint.reqSchema && (
                                            <div className="glass-card rounded-2xl overflow-hidden">
                                                <div className="flex items-center justify-between px-5 py-3 border-b border-white/5 bg-white/[0.02]">
                                                    <h3 className="text-sm font-semibold text-slate-200">Request Body Schema</h3>
                                                    <CopyButton textToCopy={JSON.stringify(activeEndpoint.reqSchema, null, 2)} onCopy={() => showToast('Request Schema Copied', 'success')}/>
                                                </div>
                                                <div className="p-5 font-mono text-[13px] leading-6 overflow-x-auto">
                                                    <pre dangerouslySetInnerHTML={getMarkup(activeEndpoint.reqSchema)} />
                                                </div>
                                            </div>
                                        )}

                                        <div className="glass-card rounded-2xl overflow-hidden">
                                            <div className="flex items-center justify-between px-5 py-3 border-b border-white/5 bg-white/[0.02]">
                                                <h3 className="text-sm font-semibold text-slate-200">Response Object Schema</h3>
                                                <div className="flex items-center gap-3">
                                                    <span className="flex items-center gap-1.5 text-xs font-medium text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded border border-emerald-500/20">
                                                        <div className="w-1.5 h-1.5 rounded-full bg-emerald-400"></div> 200 OK
                                                    </span>
                                                    <CopyButton textToCopy={JSON.stringify(activeEndpoint.resSchema, null, 2)} onCopy={() => showToast('Response Schema Copied', 'success')}/>
                                                </div>
                                            </div>
                                            <div className="p-5 font-mono text-[13px] leading-6 overflow-x-auto">
                                                <pre dangerouslySetInnerHTML={getMarkup(activeEndpoint.resSchema)} />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {/* Right Column: Try It Panel */}
                                <div className="xl:col-span-5">
                                    <div className="glass-card rounded-3xl overflow-hidden flex flex-col sticky top-8">
                                        <div className="px-6 py-4 border-b border-white/5 bg-gradient-to-r from-brand-600/10 to-transparent flex items-center gap-2">
                                            <IconPlay />
                                            <h2 className="font-bold text-white">Live Request Playground</h2>
                                        </div>
                                        
                                        <div className="p-6 space-y-6">
                                            {/* Auth Field */}
                                            {activeEndpoint.auth && (
                                                <div className="space-y-2">
                                                    <label className="text-xs font-semibold text-slate-400 uppercase tracking-wider flex items-center justify-between">
                                                        Bearer Token <span className="text-orange-400">*Required</span>
                                                    </label>
                                                    <input 
                                                        type="text" 
                                                        value={globalToken}
                                                        onChange={(e) => setGlobalToken(e.target.value)}
                                                        className="form-input placeholder:text-slate-600 font-mono text-sm"
                                                        placeholder="eyJhbGciOiJIUzI1NiIs..." 
                                                    />
                                                </div>
                                            )}

                                            {/* Dynamic Form Fields */}
                                            {activeEndpoint.fields.length > 0 && (
                                                <div className="space-y-4">
                                                    <div className="h-px bg-white/5 w-full"></div>
                                                    <h3 className="text-xs font-semibold text-slate-400 uppercase tracking-wider">Parameters</h3>
                                                    <div className="space-y-4">
                                                        {activeEndpoint.fields.map(f => (
                                                            <div key={f.name}>
                                                                <label className="block text-sm font-medium text-slate-300 mb-1.5">{f.name}</label>
                                                                {f.type === 'file' ? (
                                                                    <div className="relative">
                                                                        <input 
                                                                            type="file" 
                                                                            accept={f.accept}
                                                                            onChange={(e) => handleFormChange(e, f.name, f.type)}
                                                                            className="w-full text-sm text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-brand-500 file:text-white hover:file:bg-brand-600 cursor-pointer border border-dashed border-white/20 rounded-xl p-2 bg-black/20"
                                                                        />
                                                                    </div>
                                                                ) : (
                                                                    <input 
                                                                        type={f.type} 
                                                                        placeholder={f.placeholder}
                                                                        value={formData[f.name] || ''}
                                                                        onChange={(e) => handleFormChange(e, f.name, f.type)}
                                                                        className="form-input text-sm"
                                                                    />
                                                                )}
                                                            </div>
                                                        ))}
                                                    </div>
                                                </div>
                                            )}

                                            <button 
                                                onClick={executeRequest}
                                                disabled={loading}
                                                className={`w-full py-3.5 rounded-xl font-bold flex items-center justify-center gap-2 transition-all shadow-[0_0_20px_rgba(59,130,246,0.3)]
                                                    ${loading ? 'bg-brand-600/50 text-white/50 cursor-not-allowed' : 'bg-brand-600 hover:bg-brand-500 text-white hover:shadow-[0_0_25px_rgba(59,130,246,0.5)]'}
                                                `}
                                            >
                                                {loading ? (
                                                    <span className="flex items-center gap-2">
                                                        <svg className="animate-spin h-5 w-5 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle><path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                                        Sending Request...
                                                    </span>
                                                ) : (
                                                    <span>Send Request</span>
                                                )}
                                            </button>
                                        </div>

                                        {/* Result View */}
                                        <div className="bg-[#0A0D14] border-t border-white/5 flex-1 min-h-[250px] relative flex flex-col">
                                            <div className="absolute top-3 right-3 z-10">
                                                {response && <CopyButton textToCopy={JSON.stringify(response, null, 2)} onCopy={() => showToast('Response Copied', 'success')}/>}
                                            </div>
                                            
                                            <div className="px-5 py-3 border-b border-white/5 flex items-center justify-between sticky top-0 bg-[#0A0D14]/90 backdrop-blur-sm z-0">
                                                <h3 className="text-xs font-semibold text-slate-400 tracking-wider">Response Output</h3>
                                                {responseStatus && (
                                                    <span className={`text-[10px] px-2 py-0.5 rounded font-bold ${responseStatus >= 200 && responseStatus < 300 ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20'}`}>
                                                        status: {responseStatus}
                                                    </span>
                                                )}
                                            </div>
                                            
                                            <div className="p-5 font-mono text-[13px] leading-relaxed overflow-x-auto flex-1">
                                                {response ? (
                                                    <pre dangerouslySetInnerHTML={getMarkup(response)} />
                                                ) : (
                                                    <div className="h-full flex items-center justify-center text-slate-600 text-sm">
                                                        Hit "Send Request" to view live API response
                                                    </div>
                                                )}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </main>

                    {toast && <Toast message={toast.message} type={toast.type} onClose={() => setToast(null)} />}
                </div>
            );
        };

        const root = ReactDOM.createRoot(document.getElementById('root'));
        root.render(<App />);
    </script>
</body>
</html>
