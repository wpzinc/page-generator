# Remove vendor directory
cd ..
rm -rf vendor

# Run composer to only install non-dev dependencies
composer install --no-dev

# Build ZIP file, excluding non-Plugin files
cd ..
rm page-generator.zip
zip -r page-generator.zip . \
-x "*.scss" \
-x "*.git*" \
-x ".scripts/*" \
-x "tests/*" \
-x "vendor/*" \
-x "*.distignore" \
-x "*.env.*" \
-x ".gitignore" \
-x "*.md" \
-x "*codeception.*" \
-x "composer.json" \
-x "composer.lock" \
-x "config.codekit3" \
-x "phpcs.tests.xml" \
-x "phpcs.xml" \
-x "*.DS_Store" \

# Run composer to install dev dependencies, returning enviornment back to original state
composer update