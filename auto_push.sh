#!/bin/bash

# Set up Git if needed
git init

# Optional: Set remote (only needed once)
git remote set-url origin https://github.com/evanssamwel/Time-Table-Generator-php.git

# Find and process each file (excluding .git directory)
find . -type f ! -path "./.git/*" | while read -r file; do
    # Add the file
    git add "$file"

    # Commit the file with a unique message
    git commit -m "Add file: $file"

    # Push the commit
    git push origin HEAD
done
