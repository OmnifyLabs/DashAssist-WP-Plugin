#!/bin/bash

# Script to generate production zip file for WooCommerce extension
# Usage: ./build-zip.sh

# Set variables
PLUGIN_NAME="dashassist"
TEMP_DIR="/tmp/$PLUGIN_NAME"
CURRENT_DIR=$(pwd)
ZIP_NAME="$PLUGIN_NAME.zip"

# Clean up any existing temporary directory
rm -rf $TEMP_DIR
rm -f $CURRENT_DIR/$ZIP_NAME

# Create temporary directory
mkdir -p $TEMP_DIR

# Copy all files to temporary directory, excluding .git and any other development files
echo "Copying files to temporary directory..."
cp -r * $TEMP_DIR/ 2>/dev/null

# Remove files that shouldn't be included in the production zip
cd $TEMP_DIR
rm -f $ZIP_NAME
rm -f build-zip.sh
rm -f *.zip

# Optional: Remove development-only files
# Uncomment and modify as needed
# rm -rf node_modules
# rm -rf .vscode
# rm -f .eslintrc
# rm -f .stylelintrc
# rm -f composer.lock

echo "Creating zip file..."
# Create the zip file with all contents in the parent directory
cd /tmp
zip -r $ZIP_NAME $PLUGIN_NAME

# Move the zip file back to the project directory
mv $ZIP_NAME $CURRENT_DIR/

# Clean up
rm -rf $TEMP_DIR

echo "Production zip file created: $CURRENT_DIR/$ZIP_NAME"
echo "Done!"
