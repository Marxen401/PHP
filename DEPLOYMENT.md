# PHP Assignment – Deployment Guide

## Why Not Vercel Directly?
Vercel is a JavaScript/Node.js platform and **does not natively run PHP**.
The easiest free option that supports PHP out of the box is **Render** (render.com)
or you can use **000webhost** / **Hostinger Free Hosting**.  
Steps below cover **Render** (recommended, free tier, modern).

---

## Step 1 – Create a GitHub Repository

1. Go to [github.com](https://github.com) and sign in.  
2. Click **New repository**.  
3. Name it something like `php-assignment`.  
4. Check **Initialize this repository** (adds a README so you can upload files via the browser).  
5. Click **Create repository**.

## Step 2 – Upload Your Files

1. Inside the new repo, click **Add file → Upload file**.  
2. Drag and drop (or browse for) these three files:
   - `index.php`
   - `form.php`
   - `functions.php`
3. Scroll down, write a commit message like *"Initial upload – PHP assignment"*, and click **Commit changes**.

## Step 3 – Deploy to Render (Free PHP Hosting)

1. Go to [render.com](https://render.com) and create a free account (sign in with GitHub).  
2. Click **New → Web Service**.  
3. Connect your GitHub account and select the `php-assignment` repo.  
4. Under **Runtime**, choose **PHP**.  
5. Leave the default build and start commands.  
6. Click **Create Web Service**.  
7. Render will give you a URL like `https://php-assignment-xxxx.onrender.com`.

## Step 4 – Test Your Pages

| Page | URL |
|------|-----|
| Main (Part 1) | `https://your-url.onrender.com/index.php` |
| Form (Part 2a) | `https://your-url.onrender.com/form.php` |
| Functions (Part 2b) | `https://your-url.onrender.com/functions.php` |

---

## What to Submit
- The **three .php files** uploaded to the dropbox.  
- The **live URL** (e.g., `https://php-assignment-xxxx.onrender.com/index.php`) uploaded to the dropbox.
