const express = require('express');
const axios = require('axios');
const path = require('path');
const app = express();
const port = 4000;

app.use(express.static(path.join(__dirname, 'public')));

app.get('/', async (req, res) => {
    try {
        const response = await axios.get('https://jsonplaceholder.typicode.com/posts');
        let data = response.data;

        const {id, title} = req.query;

        if (id){
            data = data.filter(post => post.id == id);
        }

        if  (title) {
            data = data.filter(post => post.title.toLowerCase().includes(title.toLowerCase()))
        }

        let tableHTML = `
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Data Posts (Node.js)</title>
            <link rel="stylesheet" href="/stylee.css?v=1.1">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

        </head>
        <body>
            <h1>Data Posts dari JSON Placeholder API (Node.js)</h1>
            <form method="GET">
             <label for="id">Filter by ID:</label>
                <input type="text" id="id" name="id" value="${id || ''}">
                <label for="title">Filter by Title:</label>
                <input type="text" id="title" name="title" value="${title || ''}">
                <button type="submit">Filter</button>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Body</th>
                    </tr>
                </thead>
                <tbody>`;

        data.forEach(post => {
            tableHTML += `
            <tr>
                <td>${post.id}</td>
                <td>${post.title}</td>
                <td>${post.body}</td>
            </tr>`;
        });

        tableHTML += `
                </tbody>
            </table>
        </body>
        </html>`;
        
        res.send(tableHTML);
    } catch (error) {
        res.status(500).send('Error fetching data');
    }
});

app.listen(port, () => {
    console.log(`Server berjalan di http://localhost:${port}`);
});
