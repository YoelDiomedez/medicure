#!/bin/bash

PRINCE_VERSION="15.1"
echo "-----> Installing PrinceXML $PRINCE_VERSION"
[ -d .downloads ] || mkdir .downloads
(cd .downloads; [ -d "prince-$PRINCE_VERSION-linux-amd64-static" ] ||
  curl -s https://www.princexml.com/download/prince-$PRINCE_VERSION-linux-generic-x86_64.tar.gz | tar xzf -)

if [ -f $3/LICENSE ]; then
  echo "       Configuring license file"
  cp $3/LICENSE ./.downloads/prince-$PRINCE_VERSION-linux-generic-x86_64/lib/prince/license/license.dat
else
  echo "       No license found"
fi

echo $1 | ./.downloads/prince-$PRINCE_VERSION-linux-generic-x86_64/install.sh
cat >$1/bin/prince <<EOF
#!/bin/sh
exec /app/lib/prince/bin/prince --prefix="/app/lib/prince" "\$@"
EOF