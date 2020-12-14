#!/bin/sh

## npm ci
npm run build
rename 's/library/XT-Sentry-for-Joomla/' build/release/library_v?.?.?.zip
