# Computer vision for plane recognition

This project deals with the implementation of convolutional neural networks 
algorithms to perform planes recognition on satellite images. The project
relies on a specific framework that was developped by Airbus, whose
name is "khumeia". I worked on Google Cloud Platform with "powerful"
instances.

using this framework, I exploited labelled input satellite images in several
steps :

1 - Creating a set of labelled 64x64 sample images. Labels are "aircraft" vs 
"background"

2 - Designing and training a CNN with this set

3 - Testing the model on new raw satellite images 
