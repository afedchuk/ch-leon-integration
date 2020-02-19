#!/usr/bin/python

import os
import sys

stage = sys.argv[1]

for k, v in os.environ.items():
    if k.startswith(stage):
        key = k[len(stage) + 1:]
        value = '"%s"' %(v)
        print('export %s=%s' %(key, value))
