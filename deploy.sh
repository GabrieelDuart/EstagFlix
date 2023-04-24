#!/usr/bin/env bash



ssh user@192.168.1.145 << EOF

echo "OIEEEEEEEEEEEEEEE"
if [ \$? -eq 0 ]; then
  echo "FOIIIIIIIIIIIIIIIIIII"
fi

EOF
