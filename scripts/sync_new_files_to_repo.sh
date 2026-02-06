#!/usr/bin/env bash
set -euo pipefail

if [[ $# -lt 1 ]]; then
  echo "Usage: $0 <target-repo-path>" >&2
  exit 1
fi

target_repo="$1"

if [[ ! -d "$target_repo/.git" ]]; then
  echo "Target repo not found: $target_repo" >&2
  exit 1
fi

mapfile -t new_files < <(git show --name-status --diff-filter=A --pretty=format: HEAD | awk '{print $2}')

if [[ ${#new_files[@]} -eq 0 ]]; then
  echo "No added files found in the latest commit." >&2
  exit 1
fi

for file in "${new_files[@]}"; do
  if [[ ! -f "$file" ]]; then
    echo "Skipping missing file: $file" >&2
    continue
  fi
  mkdir -p "$target_repo/$(dirname "$file")"
  cp "$file" "$target_repo/$file"
  echo "Copied $file"
done

cat <<'SUMMARY'
Copy complete. Review changes in the target repo and commit/push as needed.
SUMMARY
