import * as React from 'react'
import {FC, useEffect, useState} from 'react'
import axios from "axios";
import Step from "./Step";
import StepBackward from "./StepBackward";
import Alert from 'react-bootstrap/Alert';
import Button from 'react-bootstrap/Button';
import Card from "react-bootstrap/Card";
import Col from "react-bootstrap/Col";
import Form from "react-bootstrap/Form";
import Row from "react-bootstrap/Row";
import {WizardData} from "./Wizard";
import Endpoints from "../../sdk/endpoints";

interface Props extends Step {
    visible: boolean;
    minLettersCount: number;
    maxLettersCount: number;
    data: WizardData;
}

const StepThree: FC<Props> = ({visible, minLettersCount, maxLettersCount, onBackward, data}: Props) => {
    const [key, setKey] = useState('')
    const [isSaving, setIsSaving] = useState(false);
    const [saved, setSaved] = useState(false);

    useEffect(() => {setSaved(false)}, [visible])
    useEffect(() => {
        if (!data.dateStart
            || !data.uuid
            || data.letters.length < minLettersCount
            || data.letters.length > maxLettersCount) {
            return
        }
        axios.post(Endpoints.keys(), {date: data.dateStart, uuid: data.uuid, letters: data.letters}).then(result => {
            setKey(result.data.key)
        })
    }, [data])

    const handleBackward = () => {
        onBackward()
    }

    const handleSave = () => {
        setIsSaving(true)
        setSaved(false)
        axios.post(Endpoints.batches(), {
            "range-start": data.dateStart,
            "range-stop": data.dateStop,
            uuid: data.uuid,
            letters: data.letters}).then(result => {
                setSaved(true)
        }).finally(() => setIsSaving(false))
    }

    if (!visible) {
        return null
    }
    return (
        <Card bg="light">
            <Card.Header as="h5">Krok 3/3</Card.Header>
            <Card.Body>
                <Form.Group as={Row} controlId="formDates">
                    <Form.Label column sm="2">
                        Wybrany zakres dat
                    </Form.Label>
                    <Col sm="10">
                        <Form.Control size="lg" plaintext readOnly defaultValue={[data.dateStart, data.dateStop].join(' - ')} />
                    </Col>
                </Form.Group>
                <Form.Group as={Row} controlId="formLetters">
                    <Form.Label column sm="2">
                        Wybrane litery
                    </Form.Label>
                    <Col sm="10">
                        <Form.Control size="lg" plaintext readOnly defaultValue={data.letters.join(', ')} />
                    </Col>
                </Form.Group>
                <Form.Group as={Row} controlId="formUuid">
                    <Form.Label column sm="2">
                        UUID
                    </Form.Label>
                    <Col sm="10">
                        <Form.Control size="lg" plaintext readOnly defaultValue={data.uuid} />
                    </Col>
                </Form.Group>
                <Form.Group as={Row} controlId="formKey">
                    <Form.Label column sm="2">
                        Podgląd klucza dla {data.dateStart}
                    </Form.Label>
                    <Col sm="10">
                        <Form.Control size="lg" plaintext readOnly defaultValue={key} />
                    </Col>
                </Form.Group>
                <Button disabled={isSaving} variant="primary" size="lg" block onClick={handleSave}>
                    {isSaving ? 'Zapisuję...' : 'Zapisz klucze'}
                </Button>
                <br/>
                <Alert dismissible variant="success" show={saved} onClose={() => setSaved(false)}>
                    <Alert.Heading>Dane zostały zapisane</Alert.Heading>
                </Alert>
                <StepBackward onClick={handleBackward}/>
            </Card.Body>
        </Card>
    )
}

export default StepThree
