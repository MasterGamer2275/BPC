 const { exec } = require('child_process');

// Function to start the server
function startServer() {
  const serverProcess = exec('node server.js');

  serverProcess.stdout.on('data', (data) => {
    console.log(`Server output: ${data}`);
  });

  serverProcess.stderr.on('data', (data) => {
    console.error(`Server error: ${data}`);
  });

  serverProcess.on('close', (code) => {
    console.log(`Server process exited with code ${code}`);
  });
}

// Call the function to start the server
startServer();
